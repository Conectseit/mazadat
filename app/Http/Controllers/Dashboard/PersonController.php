<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Http\Requests\Dashboard\users\PersonRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PersonController extends Controller
{

    public function index()
    {
        $data['persons'] = User::where('is_company', 'person')->get();
        return view('Dashboard.Persons.index', $data);
    }

    public function create()
    {
        $data['latest_persons'] = User::where('type', 'person')->orderBy('id', 'desc')->take(5)->get();
        $data['cities'] = City::all();
        $data['nationalities'] = Nationality::all();
        return view('Dashboard.Buyers.create', $data);
    }

    public function store(SellerRequest $request)
    {
        DB::beginTransaction();
        try {
            $person = new User();
            $person->type = 'person';
            $person->is_company = $request->is_company;
            $person->is_accepted = 1;
            $person->is_active = 'active';
            if ($request->image) {
                $person->image =  uploaded($request->image,'user');
            }
            if ($request->commercial_register_image) {
                $person->commercial_register_image =  uploaded($request->commercial_register_image,'user');
            }
            if ($request->latitude) {
                $person->latitude = $request->latitude;
            }
            if ($request->longitude) {
                $person->longitude = $request->longitude;
            }
            $person->full_name = $request->full_name;
            $person->user_name = $request->user_name;
            $person->email = $request->email;
            $person->mobile = $request->mobile;
            $person->P_O_Box = $request->P_O_Box;
            $person->password = $request->password;
            $person->gender = $request->gender;
            $person->is_appear_name = $request->is_appear_name;
            $person->nationality_id = $request->nationality_id;
            $person->country_id = 1;
            $person->city_id = $request->city_id;
            $person->save();

            if ($person) {
                $jwt_token = JWTAuth::fromUser($person);
                Token::create(['jwt' => $jwt_token, 'user_id' => $person->id,]);
            }
//            $token = new Token();
//            $token->user_id = $person->id;
//            $token->jwt='';
//            $token->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('persons.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
        }
//            $request_data = $request->except(['image','commercial_register_image']);
//            if ($request->image) $request_data['image'] = uploaded($request->image, 'user');
//            if ($request->commercial_register_image) $request_data['commercial_register_image'] = uploaded($request->commercial_register_image, 'user');
//        $person = User::create($request_data)+(['is_accepted'=>'1','type'=>'person','country_id' => '1']);
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
        $user = User::find($request->id);


        $request_data = $request->except('image');
        if ($request->hasFile('image')) {
            if (!is_null($user->image)) unlink('uploads/users/' . $user->image);
            $request_data['image'] = uploaded($request->image, 'user');
        }

        $user->update($request_data);
//        User::findOrFail($id)->update($request_data);
        return redirect()->route('persons.index')->with('success',  trans('messages.messages.updated_successfully'));
    }


    public function show($id)
    {
        if (!User::find($id)) {
            return redirect()->route('persons.index')->with('class', 'danger')->with('message', trans('messages.messages.try_access_not_found_content'));
        }
        $data['person'] = User::find($id);
        $data['person_auctions'] = AuctionBuyer::where('person_id',$id)->get();
        return view('Dashboard.Buyers.show', $data);
    }



    public function destroy(Request $request)
    {
        $person = User::find($request->id);

        if (!$person) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Buyer is not exists !!']);
        try {
            $person->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }



}
