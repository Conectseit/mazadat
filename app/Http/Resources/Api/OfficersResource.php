<?php

namespace App\Http\Resources\Api;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $mobile = Setting::where('key', 'mobile')->first()->value;
        $email = Setting::where('key', 'email')->first()->value;
        $fax = Setting::where('key', 'fax')->first()->value;
        $address = Setting::where('key', 'address')->first()->value;
//        $name = 'name_' . app()->getLocale();
        return [
            'Mobile'      =>$mobile,
            'Email'       =>$email,
            'Fax'         =>$fax,
            'Address'     =>$address,
        ];

    }
}
