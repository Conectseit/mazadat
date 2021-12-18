<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Models\Auction;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function index()
    {
        $data['sellers'] = User::where('type', 'seller')->get();
        return view('Dashboard.Sellers.index', $data);
    }

    public function create()
    {
        $data['latest_sellers'] = User::where('type', 'seller')->orderBy('id', 'desc')->take(5)->get();
        $data['cities'] = City::all();
        return view('Dashboard.Sellers.create', $data);
    }

    public function store(SellerRequest $request)
    {
        DB::beginTransaction();
        try {
//            $seller = User::create($request->all() + ['type' => 'seller','is_accepted','1'])->except('confirm_password');
            $seller = new User();
            $seller->type = 'seller';
            $seller->is_accepted = 1;
            $seller->full_name = $request->full_name;
            $seller->user_name = $request->user_name;
            $seller->email = $request->email;
            $seller->mobile = $request->mobile;
            $seller->password = $request->password;
            $seller->gender = $request->gender;
            $seller->is_appear_name = $request->is_appear_name;
            $seller->city_id = $request->city_id;
            $seller->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('sellers.create')
                ->with('message', trans('dash.messages.something_went_wrong_please_try_again'))->with('class', 'warning')->withInput($request->validated());
        }
        return redirect()->route('sellers.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));

    }


    public function edit($id)
    {
        if (!User::find($id)) {
            return redirect()->route('sellers.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_sellers'] = User::where('type', 'seller')->orderBy('id', 'desc')->take(5)->get();
        $data['seller'] = User::find($id);
        return view('Dashboard.Sellers.edit', $data);
    }

    public function update(SellerRequest $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect()->route('sellers.index')->with('success',  trans('messages.messages.updated_successfully'));
    }


    public function show($id)
    {
        if (!User::find($id)) {
            return redirect()->route('sellers.index')->with('class', 'danger')->with('message', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['seller'] = User::find($id);
        $data['seller_auctions'] = Auction::where('seller_id', $id)->get();

        return view('Dashboard.Sellers.show', $data);
    }


    public function destroy(Request $request)
    {
        $seller = User::find($request->id);

        if (!$seller) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Seller is not exists !!']);
        try {
            $seller->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }

}
