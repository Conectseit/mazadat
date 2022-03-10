<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
//            'first_name'          => $this->first_name,
//            'middle_name'         => $this->middle_name,
//            'last_name'           => $this->last_name,
//
//            'latitude'                     => isset($this->latitude)?$this->latitude:null,
//            'longitude'                    => isset($this->longitude)?$this->longitude:null,
//            'commercial_register_image'    => isset($this->commercial_register_image_path)?$this->commercial_register_image_path:null,
//            'company_authorization_image'  => isset($this->company_authorization_image_path)?$this->company_authorization_image_path:null,

            'id'                  => $this->id,
            'image'               => $this->image_path,
            'user_name'           => $this->user_name ,
            'email'               => $this->email,
            'mobile'              => ltrim($this->mobile,$this->country->phone_code),
            'is_company'          => $this->is_company,
            'is_completed'        => $this->is_completed,
            'is_active'           => $this->is_active,
            'is_accepted'         => $this->is_accepted,
            'is_verified'         => $this->is_verified,
            'ban'                 => $this->ban,
            'token'               => $this->token->jwt,

        ];

    }
}



//            'mobile'              => $this->mobile,
//            'type'                => $this->type,
//            'nationality'         => $this->nationality->$name,
//            'nationality_id'      => $this->nationality->id,
//            'city'                => $this->city->$name,
//            'city_id'             => $this->city->id,
//            'bio'                 => $this->bio,
//            'P_O_Box'             => $this->P_O_Box,
