<?php

namespace App\Http\Controllers\front;

use App\Firebase\Firebase;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\auction\AddAuctionRequest;

use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\Category;
use App\Models\FileName;
use App\Models\InspectionImage;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddAuctionController extends Controller
{

    public function show_add_auction()
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

        return view('front.auctions.add_auction', $data);
    }

    public function add_auction(AddAuctionRequest $request)
    {

        DB::beginTransaction();
        try {
            $serial_number = '#' . random_int(00000, 99999);

            //======= create auction =======
            $request_data = $request->except(['inspection_report_images' . 'images']);

            $auction = Auction::create($request_data + ['seller_id' => auth()->user()->id,'serial_number' => $serial_number,
                    'current_price' => $request->start_auction_price, 'status' => 'not_accepted']);


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


            if ($request->hasfile('pdf_files')) {
                foreach ($request->file('pdf_files') as $key => $file) {

                    DB::table('inspection_images')->insert([
                        'image' =>  uploaded_file($file), 'auction_id' => $auction->id,
                        'file_name_id'=>$request['file_name_ids'][$key], 'description'=>$request['descriptions'][$key], 'created_at' => now(), 'updated_at' => now()
                    ]);
                }
            }



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


    public function show_auction_update($id)
    {
        $data['auction'] = Auction::find($id);
        $data['categories'] = Category::all();
        $data['options'] = Option::all();
        $data['inspection_file_names'] = FileName::all();
//        $data['users'] = User::where('is_verified', 1)->get();
        $data['images'] = AuctionImage::where(['auction_id' => $id])->get();
        $data['inspection_report_images'] = InspectionImage::where(['auction_id' => $id])->get();

        return view('front.auctions.update_auction', $data);
    }


    public function updateAuction(Request $request, $id)
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


//        $dataa = [];
//        if ($request->hasfile('inspection_report_images')) {
//            foreach ($auction->inspectionimages as $image) {
//                unlink('uploads/inspection_report_pdf/' . $image->image);
//                $image->delete();
//            }
//            foreach ($request->file('inspection_report_images') as $key => $img) {
//                $file=$img;
//                $file_image=time().'.'.$file->getClientOriginalExtension();
//                $img->move('uploads/inspection_report_pdf',$file_image);
//                $dataa[$key] =['image' =>$file_image,'auction_id' => $auction->id,'file_name_id'=>$request->file_name_id];
//            }
//             DB::table('inspection_images')->insert($dataa);
//        }



//======= update auction options =======
        $options = [];
        if ($request->has('option_ids')) {
            $ids = array_filter($request->option_ids);

            // $auction->option_details->sync($ids); in case of we build a many to many relationship

            DB::table('auction_data')->where('auction_id', $auction->id)->delete();

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

        $auction = $auction->update($request_data + ['current_price' => $request->start_auction_price, 'status' => 'not_accepted',]);
        return redirect()->route('front.my_auctions')->with('success', trans('messages.messages.updated_successfully'));
    }


    public function destroy(Request $request)
    {
        $auction = Auction::find($request->id);
        if (!$auction) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, auction is not exists !!']);

        try {
            if (!is_null($auction->auctionimages))
                foreach ($auction->auctionimages as $image) {
                    unlink('uploads/auctions/' . $image->image);
                }
            if (!is_null($auction->inspectionimages))
                foreach ($auction->inspectionimages as $image) {
                    unlink('uploads/inspection_report_pdf/' . $image->image);
                }
            $auction->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


    public function destroy_file(Request $request)
    {
        $auctionimage = InspectionImage::find($request->id);

        if (!$auctionimage) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, image is not exists !!']);
        try {
            $auctionimage->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

    public function addFile(Request $request)
    {
        //======= upload auction inspection_report_images =======
//        $dataa = [];
//        if ($request->hasfile('inspection_report_images')) {
//            foreach ($request->file('inspection_report_images') as $key => $img) {
//                $file=$img;
//                $file_image=time().'.'.$file->getClientOriginalExtension();
//                $img->move('uploads/inspection_report_pdf',$file_image);
//                $dataa[$key] =['image' =>$file_image,'auction_id' => $request->auction_id,'file_name_id'=>$request->file_name_id,'description'=>$request->description];
//            }
//        }
//
//        DB::table('inspection_images')->insert($dataa);


//
//            foreach ($request->inspection_report_images as $key => $file) {

//                DB::table('inspection_images')->insert([
//                    'image' =>  uploaded_file($file),
//                    'auction_id' => $request->auction_id,
//                    'file_name_id'=>$request->file_name_id,'description'=>$request->description, 'created_at' => now(), 'updated_at' => now()
//                ]);
//            }
//           $dataa = [];
//        if ($request->hasfile('inspection_report_images')) {
//
//        dd($request->('inspection_report_images'));
//            foreach ($request->file('inspection_report_images') as $key => $img) {
//                $file=$img;
//                $file_image=time().'.'.$file->getClientOriginalExtension();
//                $img->move('uploads/inspection_report_pdf',$file_image);

                $dataa =['image' =>uploaded_file($request->inspection_report_images),
                    'auction_id' => $request->auction_id,'file_name_id'=>$request->file_name_id,'description'=>$request->description];
//            }
             DB::table('inspection_images')->insert($dataa);
//        }




        return back()->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }

}




//======= upload auction inspection_report_images =======
//$dataa = [];
//if ($request->hasfile('inspection_report_images')) {
//    foreach ($request->file('inspection_report_images') as $key => $img) {
//        $file=$img;
//        $file_image=time().'.'.$file->getClientOriginalExtension();
//        $img->move('uploads/inspection_report_pdf',$file_image);
//        $dataa[$key] =['image' =>$file_image,'auction_id' => $auction->id,'file_name_id'=>$request->file_name_id,'description'=>$request->description];
//
//    }
//}
//DB::table('inspection_images')->insert($dataa);
