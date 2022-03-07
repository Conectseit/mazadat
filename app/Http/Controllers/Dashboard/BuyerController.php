<?php
//
//namespace App\Http\Controllers\Dashboard;
//
//use App\Http\Controllers\Controller;
//use App\Http\Requests\Dashboard\SellerRequest;
//use App\Models\Auction;
//use App\Models\AuctionBuyer;
//use App\Models\City;
//use App\Models\Nationality;
//use App\Models\Token;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
//use Tymon\JWTAuth\Facades\JWTAuth;
//
//class BuyerController extends Controller
//{
//
//    public function index()
//    {
//        $data['buyers'] = User::where('type', 'buyer')->get();
//        $data['accepted_buyers'] = User::where(['type'=> 'buyer','is_accepted'=>1])->get();
//        $data['not_accepted_buyers'] = User::where(['type'=> 'buyer','is_accepted'=>0])->get();
//        return view('Dashboard.Buyers.index', $data);
//    }
//
//    public function create()
//    {
//        $data['latest_buyers'] = User::where('type', 'buyer')->orderBy('id', 'desc')->take(5)->get();
//        $data['cities'] = City::all();
//        $data['nationalities'] = Nationality::all();
//        return view('Dashboard.Buyers.create', $data);
//    }
//
//    public function store(SellerRequest $request)
//    {
//        DB::beginTransaction();
//        try {
//            $buyer = new User();
//            $buyer->type = 'buyer';
//            $buyer->is_company = $request->is_company;
//            $buyer->is_accepted = 1;
//            $buyer->is_active = 'active';
//            if ($request->image) {
//                $buyer->image =  uploaded($request->image,'user');
//            }
//            if ($request->commercial_register_image) {
//                $buyer->commercial_register_image =  uploaded($request->commercial_register_image,'user');
//            }
//            if ($request->latitude) {
//                $buyer->latitude = $request->latitude;
//            }
//            if ($request->longitude) {
//                $buyer->longitude = $request->longitude;
//            }
//            $buyer->full_name = $request->full_name;
//            $buyer->user_name = $request->user_name;
//            $buyer->email = $request->email;
//            $buyer->mobile = $request->mobile;
//            $buyer->P_O_Box = $request->P_O_Box;
//            $buyer->password = $request->password;
//            $buyer->gender = $request->gender;
//            $buyer->is_appear_name = $request->is_appear_name;
//            $buyer->nationality_id = $request->nationality_id;
//            $buyer->country_id = 1;
//            $buyer->city_id = $request->city_id;
//            $buyer->save();
//
//            if ($buyer) {
//                $jwt_token = JWTAuth::fromUser($buyer);
//                Token::create(['jwt' => $jwt_token, 'user_id' => $buyer->id,]);
//            }
////            $token = new Token();
////            $token->user_id = $buyer->id;
////            $token->jwt='';
////            $token->save();
//
//            DB::commit();
//        } catch (Exception $e) {
//            DB::rollback();
//
//            return redirect()->route('buyers.create')
//                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
//        }
////            $request_data = $request->except(['image','commercial_register_image']);
////            if ($request->image) $request_data['image'] = uploaded($request->image, 'user');
////            if ($request->commercial_register_image) $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
////        $buyer = User::create($request_data)+(['is_accepted'=>'1','type'=>'buyer','country_id' => '1']);
//        return redirect()->route('buyers.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
//    }
//
//
//    public function edit($id)
//    {
//        if (!User::find($id)) {
//            return redirect()->route('buyers.index')->with('danger', trans('dash.messages.try_2_access_not_found_content'));
//        }
//        $data['latest_buyers'] = User::where('type', 'buyer')->orderBy('id', 'desc')->take(5)->get();
//        $data['buyer'] = User::find($id);
//        return view('Dashboard.Buyers.edit', $data);
//    }
//
//    public function update(SellerRequest $request,$id)
//    {
//        $user = User::find($id);
//
//        $request_data = $request->except('image');
//        if ($request->hasFile('image')) {
////            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
//            $request_data['image'] = uploaded($request->image, 'user');
//        }
//        if ($request->hasFile('commercial_register_image')) {
////            if (!is_null($user->commercial_register_image)) unlink('uploads/users/' . $user->commercial_register_image);
//            $request_data['commercial_register_image'] = uploaded($request->image, 'user');
//        }
//        $user->update($request_data);
////        User::findOrFail($id)->update($request_data);
//        return redirect()->route('buyers.index')->with('success',  trans('messages.messages.updated_successfully'));
//    }
//
//
//    public function show($id)
//    {
//        if (!User::find($id)) {
//            return redirect()->route('buyers.index')->with('class', 'danger')->with('message', trans('messages.messages.try_access_not_found_content'));
//        }
//        $data['buyer'] = User::find($id);
//        $data['buyer_auctions'] = AuctionBuyer::where('buyer_id',$id)->get();
//        return view('Dashboard.Buyers.show', $data);
//    }
//
//
//
//    public function destroy(Request $request)
//    {
//        $buyer = User::find($request->id);
//
//        if (!$buyer) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Buyer is not exists !!']);
//        try {
//            $buyer->delete();
//            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
//        } catch (Exception $e) {
//            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
//        }
//    }
//
//
//
//
//    public function accept($id)
//    {
//        $buyer = User::findOrFail($id);
//        $buyer->update(['is_accepted'=> 1]);
//        return back();
//    }
//    public function not_accept($id)
//    {
//        $buyer = User::findOrFail($id);
//        $buyer->update(['is_accepted'=> 0]);
//        return back();
//    }
//
//}
