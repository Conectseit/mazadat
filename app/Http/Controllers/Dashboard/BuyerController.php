<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SellerRequest;
use App\Models\Auction;
use App\Models\AuctionBuyer;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{

    public function index()
    {
        $data['buyers'] = User::where('type', 'buyer')->get();
        $data['accepted_buyers'] = User::where(['type'=> 'buyer','is_accepted'=>1])->get();
        $data['not_accepted_buyers'] = User::where(['type'=> 'buyer','is_accepted'=>0])->get();
        return view('Dashboard.Buyers.index', $data);
    }

    public function create()
    {
        $data['latest_buyers'] = User::where('type', 'buyer')->orderBy('id', 'desc')->take(5)->get();
        $data['cities'] = City::all();
        return view('Dashboard.Buyers.create', $data);
    }

    public function store(SellerRequest $request)
    {
        $buyer = User::create($request->except(['images'])+['is_accepted'=>'1','type'=>'buyer']);
        return redirect()->route('buyers.index')->with('class', 'success')->with('message', trans('messages.messages.added_successfully'));
    }


    public function edit($id)
    {
        if (!User::find($id)) {
            return redirect()->route('buyers.index')->with('danger', trans('dash.messages.try_2_access_not_found_content'));
        }
        $data['latest_buyers'] = User::where('type', 'buyer')->orderBy('id', 'desc')->take(5)->get();
        $data['buyer'] = User::find($id);
        return view('Dashboard.Buyers.edit', $data);
    }

    public function update(SellerRequest $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return redirect()->route('buyers.index')->with('success',  trans('messages.messages.updated_successfully'));
    }


    public function show($id)
    {
        if (!User::find($id)) {
            return redirect()->route('buyers.index')->with('class', 'danger')->with('message', trans('messages.messages.try_access_not_found_content'));
        }
        $data['buyer'] = User::find($id);
        $data['buyer_auctions'] = AuctionBuyer::where('buyer_id',$id)->get();
        return view('Dashboard.Buyers.show', $data);
    }



    public function destroy(Request $request)
    {
        $buyer = User::find($request->id);

        if (!$buyer) return response()->json(['deleteStatus' => false, 'error' => 'Sorry, Buyer is not exists !!']);
        try {
            $buyer->delete();
            return response()->json(['deleteStatus' => true, 'message' => 'تم الحذف  بنجاح']);
        } catch (Exception $e) {
            return response()->json(['deleteStatus' => false, 'error' => 'Server Internal Error 500']);
        }
    }




    public function accept($id)
    {
        $buyer = User::findOrFail($id);
        $buyer->update(['is_accepted'=> 1]);
        return back();
    }
    public function not_accept($id)
    {
        $buyer = User::findOrFail($id);
        $buyer->update(['is_accepted'=> 0]);
        return back();
    }

}
