<?php

namespace App\Http\Resources\Api\auth;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        $name = 'name_' . app()->getLocale();
        return [
//            'type'                => $this->type,
            'is_company'                  => $this->is_company,
            'is_completed'                => $this->is_completed,
//            'is_active'                   => $this->is_active,
//            'is_accepted'                 => $this->is_accepted,
//            'is_verified'                 => $this->is_verified,
//            'ban'                         => $this->ban,

            'commercial_register_image'   => $this->commercial_register_image_path,
            'company_authorization_image' => $this->company_authorization_image_path,
            'latitude'                    => $this->latitude ,
            'longitude'                   => $this->longitude ,
            'user_name'                   => $this->user_name ,
            'email'                       => $this->email,
            'phone_code'                  => $this->country->phone_code,
            'mobile'                      => ltrim($this->mobile,$this->country->phone_code),

            'image'                       => $this->image_path,
            'nationality_name'        => isset($this->nationality)?$this->nationality->$name:null,
            'nationality_id'          => isset($this->nationality)?$this->nationality->id:null,
            'country_name'            => isset($this->country)?$this->country->$name:null,
            'country_id'              => isset($this->country)?$this->country->id:null,
            'city_name'               => isset($this->city)?$this->city->$name:null,
            'city_id'                 => isset($this->city)?$this->city->id:null,
            'P_O_Box'                 => $this->P_O_Box,
            'ban'                     => $this->ban,
            'is_verified'             => $this->is_verified,



        ];

    }
}

//            'block'                   => $this->block,
//            'street'                  => $this->street,
//            'block_num'               => $this->block_num,
//            'delivery_time'           => $this->delivery_time,
//            'signs'                   => $this->signs,
