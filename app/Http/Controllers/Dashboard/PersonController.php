<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Http\Requests\Dashboard\users\PersonRequest;
use App\Http\Requests\Dashboard\users\WalletRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\Country;
use App\Models\Message;
use App\Models\Nationality;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Token;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PersonController extends Controller
{

    public function index()
    {
        $data['persons'] = User::where(['is_company'=> 'person','is_active'=>'active'])->latest()->get();
        $data['accepted_persons'] = User::where(['is_company'=> 'person','is_active'=>'active','is_accepted'=>1,'is_checked_account'=>1])->latest()->get();
        $data['not_accepted_persons'] = User::where(['is_company'=> 'person','is_active'=>'active','is_checked_account'=>0])->latest()->get();
        $data['not_actived_persons'] = User::where(['is_company'=> 'person','is_active'=>'deactive'])->latest()->get();
        $data['messages'] = Message::all();
        return view('Dashboard.Persons.index', $data);
    }

    public function create()
    {
        $data['latest_persons'] = User::where('is_company', 'person')->orderBy('id', 'desc')->take(5)->get();
        $data['countries'] = Country::all();
        $data['cities'] = City::all();
        $data['nationalities'] = Nationality::all();
        return view('Dashboard.Persons.create', $data);
    }

    public function store(PersonRequest $request)
    {
        DB::beginTransaction();
        try {
            $country = Country::where('id',$request->country_id)->first();
            $request_data = $request->except(['image','mobile','passport_image']);
            if ($request->image) $request_data['image'] = uploaded($request->image, 'user');
            if ($request->passport_image) $request_data['passport_image'] = uploaded($request->passport_image, 'user');
            if ($request->mobile) {
                $request_data['mobile'] =$country->phone_code. $request->mobile ;
            }

            if (User::where('mobile', $request_data['mobile'])->first()) {
                return back()->with('error', 'قيمة الجوال مستخدمة من قبل');
            }
            $person = User::create($request_data+['type' => 'buyer', 'is_company' =>'person',
                    'is_appear_name'=>1, 'is_accepted' =>1, 'is_active' =>'active',
                    'is_verified'=>1,'is_completed' =>1, 'accept_app_terms'=>'yes','is_checked_account'=>1
//                    'mobile' => $country->phone_code.$request->mobile
                ]);

            if ($person) {
                $jwt_token = JWTAuth::fromUser($person);
                Token::create(['jwt' => $jwt_token, 'user_id' => $person->id,]);
            }

// ===========================================================
            $name='name_' . app()->getLocale();
            activity()
                ->performedOn($person)
                ->causedBy(auth()->guard('admin')->user())
                ->log('قام المشرف'.auth()->guard('admin')->user()->full_name .'  باضافة مستخدم'.($person->full_name));
// ===========================================================
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('persons.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
        }
        return redirect()->route('persons.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }


    public function edit($id)
    {
        if (!User::find($id)) {
            return redirect()->route('persons.index')->with('danger', trans('dash.messages.try_2_access_not_found_content'));
        }
//        $data['latest_persons'] = User::where('type', 'person')->orderBy('id', 'desc')->take(5)->get();
        $data['person'] = User::find($id);
        return view('Dashboard.Persons.edit', $data);
    }

    public function update(PersonRequest $request,User $user)
    {
//        $user = User::find($id);
        $user = User::find($request->person_id);
        $request_data = $request->except('image');
        if ($request->hasFile('image')) {
            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
            $request_data['image'] = uploaded($request->image, 'user');
        }

        $user->update($request_data);
//        User::findOrFail($id)->update($request_data);

// ===========================================================
        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بتعديل مستخدم'.($user->full_name));
// ===========================================================

        return redirect()->route('persons.index')->with('success',  trans('messages.messages.updated_successfully'));
    }


    public function show($id)
    {
        if (!User::find($id)) {
            return redirect()->route('persons.index')->with('class', 'danger')->with('message', trans('messages.messages.try_access_not_found_content'));
        }
        $data['messages'] = Message::all();
        $data['person'] = User::find($id);
        $data['person_addresses'] = UserAddress::where('user_id',$id)->get();
        $data['person_bids'] = AuctionBuyer::where('buyer_id',$id)->get();
        return view('Dashboard.Persons.show', $data);
    }


    public function destroy(Request $request, User $user)
    {
        $user = User::find($request->id);
        if (!$user) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, user is not exists !!']);
        try {
            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
            $user->delete();

            // ===========================================================
            $name='name_' . app()->getLocale();
            activity()
                ->performedOn($user)
                ->causedBy(auth()->guard('admin')->user())
                ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بحذف مستخدم'.($user->full_name));
// ===========================================================


            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

    public function verified($id)
    {
        $person = User::findOrFail($id);
        $person->update(['is_checked_account'=> 1]);
        return back()->with('success',  trans('messages.checked_all_data_of_user_account_successfully'));
    }
    public function not_verified($id)
    {
        $person = User::findOrFail($id);
        $person->update(['is_checked_account'=> 0]);
        return back()->with('success',  trans('messages.not_verified_yet_and_send_SMS'));
    }

}
