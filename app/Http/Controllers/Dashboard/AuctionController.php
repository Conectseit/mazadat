<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuctionRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AuctionController extends Controller
{
    public function index()
    {
        $data['auctions'] = Auction::latest()->paginate(200);
        $data['on_progress_auctions'] = Auction::where('status', 'on_progress')->latest()->paginate(200);
        $data['done_auctions'] = Auction::where('status', 'done')->latest()->paginate(200);
        $data['not_accepted_auctions'] = Auction::where('status', 'not_accepted')->latest()->paginate(200);
        return view('Dashboard.Auctions.index', $data);
    }

    public function create()
    {
        $data['latest_auctions'] = Auction::orderBy('id', 'desc')->take(5)->get();
        $data['categories'] = Category::all();
        $data['users'] = User::where('type', 'seller')->get();
        return view('Dashboard.Auctions.create', $data);
    }


    public function store(AuctionRequest $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $min_duration_of_auction = Setting::where('key', 'min_duration_of_auction')->first()->value;
        $max_duration_of_auction = Setting::where('key', 'max_duration_of_auction')->first()->value;
        $min_time_unit = Setting::where('key', 'min_time_unit')->first()->value;
        $max_time_unit = Setting::where('key', 'max_time_unit')->first()->value;

        if ($min_time_unit == 'hour') {
            $min_allowed_time = Carbon::parse($start_date)->addHours($min_duration_of_auction);
        }
        if ($min_time_unit == 'day') {
            $min_allowed_time = Carbon::parse($start_date)->addDays($min_duration_of_auction);
        }
        if ($max_time_unit == 'hour') {
            $max_allowed_time = Carbon::parse($start_date)->addHours($max_duration_of_auction);
        }
        if ($max_time_unit == 'day') {
            $max_allowed_time = Carbon::parse($start_date)->addDays($max_duration_of_auction);
        }
        if ($request->end_date) {
            $end_date = date('Y-m-d H', strtotime($end_date));

            $minimum_allowed_time = $min_allowed_time->toDateTimeString();
            $maximum_allowed_time = $max_allowed_time->toDateTimeString();

            if (($end_date >= $minimum_allowed_time) && ($end_date <= $maximum_allowed_time)) {
                //======= create auction =======
                $request->is_accepted = 1;
                $auction = Auction::create($request->except(['images']) + ['is_accepted' => '1']);

                //======= upload auction images =======
                $data = [];
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $key => $img) {
                        $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                    }
                }
                $auction_images = DB::table('auction_images')->insert($data);
                return redirect()->route('auctions.index')->with('message', trans('messages.added_successfully'));
                //============
            } else {

                return back()->with('error', trans(  trans('messages.the end date should between') . ' '.$min_allowed_time . ' & ' . $max_allowed_time));
            }
        }
    }



//    public function store(AuctionRequest
//                          $request)
//    {
//
//        $max_duration_of_auction= Setting::where('key', 'max_duration_of_auction')->first()->value;
//        $min_duration_of_auction= Setting::where('key', 'min_duration_of_auction')->first()->value;
//
//        $request->is_accepted=1;
//
//
//        $dt = $request->start_date;
//        if ( Setting::where('key', 'min_time_unit')->first()->value == 'hour'){
//            $min_allowed_time = Carbon::parse($dt)->addHours(Setting::where('key', 'min_number_of_time')->first()->value);
//        }
//
//        if ( Setting::where('key', 'min_time_unit')->first()->value == 'day'){
//            $min_allowed_time = Carbon::parse($dt)->addDays(Setting::where('key', 'min_number_of_time')->first()->value);
//        }
//
//        if ( Setting::where('key', 'max_time_unit')->first()->value == 'hour'){
//            $max_allowed_time = Carbon::parse($dt)->addHours(Setting::where('key', 'max_number_of_time')->first()->value);
//        }
//
//        if ( Setting::where('key', 'max_time_unit')->first()->value == 'day'){
//            $max_allowed_time = Carbon::parse($dt)->addDays(Setting::where('key', 'max_number_of_time')->first()->value);
//        }
//            if ($request->end_date){
//                $paymentDate = $request->end_date;
//                $paymentDate=date('Y-m-d H', strtotime($paymentDate));
//
//                $contractDateBegin = $min_allowed_time->toDateTimeString();
//                $contractDateEnd = $max_allowed_time->toDateTimeString();
//
//                if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
////                    return back()->with('class', 'error')->with('message', trans('messages.test Yes'));
//                }else{
//                    return back()->with('class', 'error')
//                        ->with('error', trans('messages.the end date should between'.$min_duration_of_auction.'&'.$max_duration_of_auction));
//                }
//}
//
//
//        $auction = Auction::create($request->except(['images'])+['is_accepted'=>'1']);
//        $data = [];
//        if ($request->hasfile('images')) {
//            foreach ($request->file('images') as $key => $img) {
//                $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
//            }
//        }
//
//        $auction_images = DB::table('auction_images')->insert($data);
//        return redirect()->route('auctions.index')->with('class', 'success')->with('message', trans('messages.added_successfully'));
//    }
//


    public function show($id)
    {
        if (!Auction::find($id)) {
            return redirect()->route('auctions.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['auction'] = Auction::find($id);

        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        $data['auction_bids'] = AuctionBuyer::where(['auction_id' => $id])->get();
        return view('Dashboard.Auctions.show', $data);
    }


    public function edit($id)
    {
        if (!Auction::find($id)) {
            return redirect()->route('auctions.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_auctions'] = Auction::orderBy('id', 'desc')->take(10)->get();
        $data['auction'] = Auction::find($id);
        $data['categories'] = Category::all();
        $data['sellers'] = User::where('type', 'seller')->get();
        return view('Dashboard.Auctions.edit', $data);
    }


    public function update(AuctionRequest $request, $id)
    {
        // $request_data = $request->except(['images']);
        // $auction->update($request_data);
        $auction = Auction::find($id)->update($request->all());

        foreach (Auction::find($id)->auctionimages as $image)
        {
            File::delete('uploads/auctions/' . $image->image);
            $image->delete();
        }
        $data = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $key => $img) {
                $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $id];
            }
        }
        $auction_images = DB::table('auction_images')->insert($data);
        return redirect()->route('auctions.index')->with('success', trans('messages.messages.updated_successfully'));
    }


    public function destroy(Request $request)
    {
        $auction = Auction::find($request->id);
        if (!$auction) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, auction is not exists !!']);
        try {

            $auction->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
        // return redirect()->route('auctions.index');
    }


    public function deleteImage(Request $request)
    {
        $auctionimage = AuctionImage::find($request->id);

        if (!$auctionimage) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, image is not exists !!']);
        try {
            $auctionimage->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
        // return redirect()->route('auctions.index');
    }


}
