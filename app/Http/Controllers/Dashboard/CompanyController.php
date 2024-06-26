<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsController;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Http\Requests\Dashboard\users\CompanyRequest;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{

    public function index()
    {
        $data['companies'] = User::where('is_company', 'company')->get();
        $data['accepted_companies'] = User::where(['is_company'=> 'company','is_active'=>'active','is_accepted'=>1])->latest()->get();
        $data['not_accepted_companies'] = User::where(['is_company'=> 'company','is_active'=>'active','is_accepted'=>0])->latest()->get();
        $data['messages'] = Message::all();
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


    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();
        try {
            $country = Country::where('id',$request->country_id)->first();

            $request_data = $request->except(['image','commercial_register_image', 'company_authorization_image','mobile']);
            if ($request->commercial_register_image) {
                $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
            }
            if ($request->company_authorization_image) {
                $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
            }
            if ($request->image) $request_data['image'] = uploaded($request->image, 'user');

            if ($request->mobile) {
                $request_data['mobile'] =$country->phone_code. $request->mobile ;
            }
            if (User::where('mobile', $request_data['mobile'])->first()) {

                return back()->with('error', 'قيمة الجوال مستخدمة من قبل');
            }

            $company = User::create($request_data+['type' => 'buyer','is_appear_name'=>1,
                    'is_company'=>'company','accept_app_terms'=>'yes', 'is_accepted' =>1,
                    'is_active' => 'active', 'is_completed' =>1,'is_verified'=>1,'is_checked_account'=>1
//                    'mobile' => $country->phone_code.$request->mobile
                ]);
            if ($company) {
                $jwt_token = JWTAuth::fromUser($company);
                Token::create(['jwt' => $jwt_token, 'user_id' => $company->id,]);
            }

// ===========================================================
            activity()
                ->performedOn($company)
                ->causedBy(auth()->guard('admin')->user())
                ->log('قام المشرف'.auth()->guard('admin')->user()->full_name .'  باضافة مؤسسة'.($company->user_name));
// ===========================================================

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('companies.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
        }
        return redirect()->route('companies.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }


    public function edit($id)
    {
        if (!User::find($id)) {
            return redirect()->route('companies.index')->with('danger', trans('dash.messages.try_2_access_not_found_content'));
        }
//        $data['latest_companies'] = User::where('type', 'person')->orderBy('id', 'desc')->take(5)->get();
        $data['company'] = User::find($id);
        $data['countries'] = Country::all();
        $data['cities'] = City::all();
        $data['nationalities'] = Nationality::all();
        return view('Dashboard.Companies.edit', $data);
    }

    public function update(CompanyRequest $request,User $user)
    {
        $user = User::find($request->company_id);
        $request_data = $request->except('image','commercial_register_image','company_authorization_image');
        if ($request->hasFile('image')) {
            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
            $request_data['image'] = uploaded($request->image, 'user');
        }

        if ($request->commercial_register_image) {
            $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
        }
        if ($request->company_authorization_image) {
            $request_data['company_authorization_image'] = uploaded($request->company_authorization_image, 'user');
        }
        $user->update($request_data);

// ===========================================================
        $name='name_' . app()->getLocale();
        activity()
            ->performedOn($user)
            ->causedBy(auth()->guard('admin')->user())
            ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بتعديل مؤسسة'.($user->user_name));
// ======================
        return redirect()->route('companies.index')->with('success',  trans('messages.messages.updated_successfully'));
    }

    public function show($id)
    {
        if (!User::find($id)) {
            return redirect()->route('companies.index')->with('class', 'danger')->with('message', trans('messages.messages.try_access_not_found_content'));
        }
        $data['company'] = User::find($id);
        $data['messages'] = Message::all();
        $data['company_auctions'] = Auction::where('seller_id',$id)->get();
        $data['company_bids'] = AuctionBuyer::where('buyer_id',$id)->get();

        return view('Dashboard.Companies.show', $data);
    }


    public function destroy(Request $request, User $user)
    {
        $user = User::find($request->id);
        if (!$user) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, user is not exists !!']);
        try {
            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
            if (!is_null($user->commercial_register_image)) unlink('uploads/users/' . $user->commercial_register_image);
            if (!is_null($user->company_authorization_image)) unlink('uploads/users/' . $user->company_authorization_image);
            $user->delete();

            activity()
                ->performedOn($user)
                ->causedBy(auth()->guard('admin')->user())
                ->log('قام المشرف'.auth()->guard('admin')->user()->full_name.' بحذف مؤسسة'.($user->user_name));
// ======================
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }


    public function unique($id)
    {
        $company = User::findOrFail($id);
        $company->update(['unique_company'=> 1]);
        return back();
    }

    public function not_unique($id)
    {
        $company = User::findOrFail($id);
        $company->update(['unique_company'=> 0]);
        return back();
    }


    public function accept($id)
    {
        $company = User::findOrFail($id);
        $company->update(['is_accepted'=> 1,'is_verified'=> 1]);
        (new \App\Models\Notification)->sendAcceptAccountNotify($company->id);

        SmsController::sendSms($company->mobile, 'تم قبول حسابك  من ادرة موقع مزادات' );

        return back()->with('success',  trans('messages.active_user_and_send_SMS_successfully'));
    }
    public function not_accept($id)
    {
        $company = User::findOrFail($id);
        $company->update(['is_accepted'=> 0]);
        (new \App\Models\Notification)->sendNotAcceptAccountNotify($company->id);

        SmsController::sendSms($company->mobile, 'هناك خطأ في تكملة بيانات حسابك في موقع مزادات من فضلك ارسلها مرة اخري' );
        return back()->with('success',  trans('messages.not_verified_yet_and_send_SMS'));
    }

}
