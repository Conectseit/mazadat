<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{

    public function index()
    {
        $data['companies'] = User::where('is_company', 'company')->get();
        $data['accepted_companies'] = User::where(['is_company'=> 'company','is_accepted'=>1])->get();
        $data['not_accepted_companies'] = User::where(['is_company'=> 'company','is_accepted'=>0])->get();
        return view('Dashboard.Companies.index', $data);
    }

    public function create()
    {
        $data['latest_companies'] = User::where('is_company', 'company')->orderBy('id', 'desc')->take(5)->get();
        $data['countries'] = Country::all();
        $data['cities'] = City::all();
        $data['nationalities'] = Nationality::all();
        return view('Dashboard.Companies.create', $data);
    }


    public function store(PersonRequest $request)
    {
        DB::beginTransaction();
        try {
            $country = Country::where('id',$request->country_id)->first();

            $request_data = $request->except(['image','mobile']);
            if ($request->image) $request_data['image'] = uploaded($request->image, 'user');
            if ($request->mobile) {
                $request_data['mobile'] =$country->phone_code. $request->mobile ;
            }
            $person = User::create($request_data+['type' => 'buyer','is_company' => 'person', 'is_accepted' =>1, 'is_active' => 'active',
//                    'mobile' => $country->phone_code.$request->mobile
                ]);
            if ($person) {
                $jwt_token = JWTAuth::fromUser($person);
                Token::create(['jwt' => $jwt_token, 'user_id' => $person->id,]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('persons.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
        }
        return redirect()->route('persons.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }


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

}
