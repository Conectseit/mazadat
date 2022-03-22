<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\AuctionRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionData;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\InspectionImage;
use App\Models\Notification;
use App\Models\Option;
use App\Models\OptionDetail;
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
        $data['auctions'] = Auction::latest()->get();
        $data['on_progress_auctions'] = Auction::where('status', 'on_progress')->where('is_accepted', 1)->latest()->get();
        $data['done_auctions'] = Auction::where('status', 'done')->where('is_accepted', 1)->latest()->get();
        $data['not_accepted_auctions'] = Auction::where('status', 'not_accepted')->where('is_accepted', 0)->latest()->get();
        return view('Dashboard.Auctions.index', $data);
    }

    public function create()
    {
        $data['latest_auctions'] = Auction::orderBy('id', 'desc')->take(5)->get();
        $data['categories'] = Category::with('options')->get();
        $data['options'] = Option::all();
        $data['option_details'] = OptionDetail::all();
        $data['users'] = User::where('is_verified', 1)->get();
//        $data['users'] = User::where('type', 'seller')->get();
        return view('Dashboard.Auctions.create', $data);
    }


    public function store(AuctionRequest $request)
    {
        DB::beginTransaction();
        try {
            $serial_number = '#' . random_int(00000, 99999);
                    //======= create auction =======
                    $request_data = $request->except(['inspection_report_images' . 'images']);

                    $auction = Auction::create($request_data + ['is_accepted' => '1','status'=> 'on_progress',
                            'current_price' => $request->start_auction_price, 'serial_number' => $serial_number]);

                //======= upload auction images =======
                $data = [];
                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $key => $img) {
                        $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                    }
                }
                $auction_images = DB::table('auction_images')->insert($data);

                //======= upload auction inspection_report_images =======
                $dataa = [];
                if ($request->hasfile('inspection_report_images')) {
                    foreach ($request->file('inspection_report_images') as $key => $img) {
                        $dataa[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                    }
                }
                $auction_inspection_report_images = DB::table('inspection_images')->insert($dataa);

                //======= upload auction options =======


            $options = [];
            if(is_array($request->option_ids))
            {
                foreach ($request->option_ids as $option_detail_id) {
                    $options[$option_detail_id] = [
                        'auction_id'        => $auction->id,
                        'option_details_id' => $option_detail_id // <==== arrrray ??,
                    ];
                }
            }
            if(count($options) > 0) DB::table('auction_data')->insert($options);



//                $auction_options = AuctionData::Create([
//                    'auction_id' => $auction->id,
//                    'option_id' => $request->option_id,
//                    'option_details_id' => $request->option_details_id,
//                ]);


// ===========================================================
            Notification::sendNewAuctionNotification($auction->id);

            $name='name_' . app()->getLocale();
            activity()
                ->performedOn($auction)
                ->causedBy(auth()->guard('admin')->user())
                ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' باضافة مزاد'.($auction->$name));
// ===========================================================


            DB::commit();
            return redirect()->route('auctions.index')->with('message', trans('messages.messages.added_successfully'));

        } catch (Exception $e) {
            DB::rollback();
        }
    }


    public function show($id)
    {
        if (!Auction::find($id)) {
            return redirect()->route('auctions.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['auction'] = Auction::find($id);
        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        $data['inspection_report_images'] = InspectionImage::where(['auction_id' => $id])->get();
        $data['auction_bids'] = AuctionBuyer::where(['auction_id' => $id])->get();
        $data['auction_option_details'] = AuctionData::where(['auction_id' => $id])->get();

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
//        $data['sellers'] = User::where('type', 'seller')->get();
        $data['users'] = User::where('is_verified', 1)->get();

        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        $data['inspection_report_images'] = InspectionImage::where(['auction_id' => $id])->get();


        return view('Dashboard.Auctions.edit', $data);
    }


    public function update(AuctionRequest $request, $id)
    {

        $auction = Auction::find($id);

        $request_data = $request->except(['images', 'inspection_report_images']);
        $data = [];
        if ($request->hasfile('images')) {
            foreach ($auction->auctionimages as $image) {
                unlink('uploads/auctions/' . $image->image);
                $image->delete();
            }
            foreach ($request->file('images') as $key => $img) {
                $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $id];
            }
            $auction_images = DB::table('auction_images')->insert($data);
        }

        $dataa = [];
        if ($request->hasfile('inspection_report_images')) {
            foreach ($auction->inspectionimages as $image) {
                unlink('uploads/auctions/' . $image->image);
                $image->delete();
            }
            foreach ($request->file('inspection_report_images') as $key => $img) {
                $dataa[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $id];
            }
            $auction_inspection_images = DB::table('inspection_images')->insert($dataa);
        }


        //======= update auction options =======
        $options = [];
        if ($request->has('option_ids')) {
            $ids = array_filter($request->option_ids);

            // $auction->option_details->sync($ids); in case of we build a many to many relationship

            DB::table('auction_data')->where('auction_id',$auction->id)->delete();

            if(is_array($ids) && !empty($ids))
            {
                // if $request->option_ids is null or equal zero - has zero -> refuse it
                foreach ($ids as $option_detail_id) {
                    $options[$option_detail_id] = [
                        'auction_id'        => $auction->id,
                        'option_details_id' => $option_detail_id // <==== arrrray ??,
                    ];
                }
            }}

//        foreach ($auction->option_details as $option_detail) {
//            $option_detail->delete();
//        }

        if(count($options) > 0) DB::table('auction_data')->insert($options);






// ===========================================================

        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($auction)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بتعديل مزاد'.($auction->$name));
// ===========================================================

        $auction->update($request_data);
        return redirect()->route('auctions.index')->with('success', trans('messages.messages.updated_successfully'));
    }


    public function destroy(Request $request)
    {
        $auction = Auction::find($request->id);
        if (!$auction) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, auction is not exists !!']);
//            foreach ($auction->auctionimages as $image) {
//                unlink('uploads/auctions/' . $image->image);
//            }
        try {
            $auction->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
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


    public function get_options_by_category_id(Request $request)
    {
        return Option::getOptionsByCategoryId($request);
    }



//    public function get_option_details_by_option_id(Request $request)
//    {
//        $option = Option::find($request->option_id);
//
//        if (!$option) return response()->json(['status' => false], 500);
//
//        return response()->json(['option_details' => $option->option_details, 'status' => true], 200);
//    }



    public function accept($id)
    {
        $auction = Auction::findOrFail($id);
        if(is_null($auction->start_date) && is_null($auction->end_date ) )
            {
                return redirect()->route('auctions.index')->with('error', trans('messages.Sorry_you_should_complete_all_data_for_auction_first'));
            }

        $auction->update(['is_accepted'=> 1,'status'=>'on_progress']);

        SmsController::send_sms($auction->seller->mobile, 'تم قبول مزادك من ادرة موقع مزادات' );
        Notification::sendNewAuctionNotification($auction->id);

        return redirect()->route('auctions.index')->with('success', trans('messages.accept_auction'));
    }
//    public function not_accept($id)
//    {
//        $auction = Auction::findOrFail($id);
//        $auction->update(['is_accepted'=> 0]);
//        return back();
//    }

    public function make_done($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update(['status'=> 'done']);
        return back()->with('success', trans('messages.make_done_auction'));
    }
    public function need_update($id)
    {
        $auction = Auction::findOrFail($id);

        $user = User::where('id',$auction->seller_id)->first();
        SmsController::send_sms($user->mobile, trans('messages.update_your_auction_and_send_it_again'));

        return back()->with('success', trans('messages.send_sms_to_auction_owner_successfully'));
    }

    public function unique($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update(['is_unique'=> 1]);
        return back();
    }
    public function not_unique($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update(['is_unique'=> 0]);
        return back();
    }



}
