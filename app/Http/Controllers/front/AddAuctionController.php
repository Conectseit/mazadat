<?php

namespace App\Http\Controllers\front;

use App\Firebase\Firebase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\AddAuctionRequest;
use App\Http\Requests\Front\auction\MakeBidRequest;
use App\Models\AcceptedAuction;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\FileName;
use App\Models\InspectionImage;
use App\Models\Notification;
use App\Models\Option;
use App\Models\User;
use App\Models\WatchedAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddAuctionController extends Controller
{

    public function show_add_auction1()
    {

        if (auth()->user()->is_completed == 0) {
            return redirect()->route('front.show_complete_profile')
                ->with('error', trans('api.please_complete_your_account_first'));
        }

        if (auth()->user()->is_verified == 0) {
            return back()->with('error', trans('messages.please_wait_your_account_not_verified_to_participate_yet'));
        }

        $data['categories'] = Category::all();
        $data['options'] = Option::all();
        $data['inspection_file_names'] = FileName::all();

        return view('front.auctions.add_auction1', $data);
    }

    public function add_auction1(AddAuctionRequest $request)
    {
dd(count($request->image));
        DB::beginTransaction();
        try {
            $serial_number = '#' . random_int(00000, 99999);
            //======= create auction =======
            $request_data = $request->except(['inspection_report_images' . 'images']);

            $auction = Auction::create($request_data + ['seller_id' => auth()->user()->id,
                    'current_price' => $request->start_auction_price, 'status' => 'not_accepted', 'serial_number' => $serial_number]);


            //======= upload auction images =======
            $data = [];
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $img) {
                    $data[$key] = ['image' => uploaded($img, 'auction'), 'auction_id' => $auction->id];
                }
            }
            $auction_images = DB::table('auction_images')->insert($data);


//
//            //1 ======= upload auction inspection_report_images =======
//            $dataa = [];
//            if ($request->hasfile('inspection_report_images')) {
//                foreach ($request->file('inspection_report_images') as $key => $img) {
//                    $file=$img;
//                    $file_image=time().'.'.$file->getClientOriginalExtension();
//                    $img->move('uploads/inspection_report_pdf',$file_image);
//                    $dataa[$key] =['image' =>$file_image,'auction_id' => $auction->id,'file_name_id'=>$request->file_name_id];
//
//                }
//            }
//            DB::table('inspection_images')->insert($dataa);


//            $inspection_reports = [];
//
//            $file_name_ids = $request->input('file_name_id');
//            dd($file_name_ids);
//            $descriptions = $request->input('description');
////            $images = $request->file('image');
//
//            foreach ($file_name_ids as $key => $file_name_id) {
//
////                $filee = $file['image'];
////                $file_image = time() . '.' . $filee->getClientOriginalExtension();
////                $file['image']->move('uploads/inspection_report_pdf', $file_image);
//
//                $inspection_report = new InspectionImage();
//
////                $inspection_report->description = $request->input('description');
//                $inspection_report->file_name_id = $file_name_id;
//                $inspection_report->auction_id = $auction->id;
////                $inspection_report->image = $file_image;
//
//                $inspection_report->save();
//                array_push($inspection_reports, $inspection_report);
//            }


            $inspection_reports = [];
            $files = $request['files'];
            foreach (array($files) as $file) {

                // Save report image
                $filee = $file['image'];
                $file_image = time() . '.' . $filee->getClientOriginalExtension();
                $file['image']->move('uploads/inspection_report_pdf', $file_image);

                $inspection_report = new InspectionImage();

                $inspection_report->auction_id = $auction->id;
                $inspection_report->description = ($file['description']);
                $inspection_report->file_name_id = $file['file_name_id'];// <==== arrrray ??,
                $inspection_report->image = $file_image;
                $inspection_report->save();

            }
            array_push($inspection_reports, $inspection_report);


            //======= upload auction options =======
            $options = [];
            if ($request->has('option_ids')) {
                $ids = $request->option_ids ? array_filter($request->option_ids) : [];

                if (is_array($ids) && !empty($ids)) {
                    // if $request->option_ids is null or equal zero - has zero -> refuse it
                    foreach ($ids as $option_detail_id) {
                        $options[$option_detail_id] = [
                            'auction_id' => $auction->id,
                            'option_details_id' => $option_detail_id // <==== arrrray ??,
                        ];
                    }
                }
            }

            if (count($options) > 0) DB::table('auction_data')->insert($options);

            DB::commit();
            return redirect()->route('front.my_auctions')->with('success', trans('messages.added_successfully_wait_until_admin_accept_your_auction'));

        } catch (Exception $e) {
            DB::rollback();
        }
    }

}

