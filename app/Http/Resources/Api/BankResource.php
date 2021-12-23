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
        $bank_name = Setting::where('key', 'bank_name')->first()->value;
        $iban = Setting::where('key', 'iban')->first()->value;
//        $name = 'name_' . app()->getLocale();
        return [
            'account_name'      =>$account_name,
            'bank_name'         =>$bank_name,
            'IBAN'              =>$iban,
        ];

    }
}
