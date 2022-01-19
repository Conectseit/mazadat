<?php

namespace App\Http\Resources\Api;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $account_name = Setting::where('key', 'account_name')->first()->value;
        $account_number = Setting::where('key', 'account_number')->first()->value;
        $branch = Setting::where('key', 'branch')->first()->value;

        $bank_name= 'bank_name_'.app()->getLocale();
        $bank_namee = Setting::where('key',$bank_name)->first()->value;

        $iban = Setting::where('key', 'iban')->first()->value;
        return [
            'bank_name'         =>$bank_namee,
            'account_name'      =>$account_name,
            'account_number'    =>$account_number,
            'branch'            =>$branch,
            'IBAN'              =>$iban,
        ];

    }
}
