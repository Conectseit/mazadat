<?php

namespace App\Http\Resources\Api\auth;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'is_company'           => $this->is_company,
            'is_completed'         => $this->is_completed,
            'first_name'           => $this->first_name,
            'middle_name'          => $this->middle_name,
            'last_name'            => $this->last_name,
            'user_name'            => $this->user_name ,
            'email'                => $this->email,
            'is_appear_name'       => (int)$this->is_appear_name,
            'phone_code'           => $this->country->phone_code,
            'mobile'               => ltrim($this->mobile,$this->country->phone_code),

            'image'                   => $this->image_path,
            'nationality_name'        => isset($this->nationality)?$this->nationality->$name:null,
            'nationality_id'          => isset($this->nationality)?$this->nationality->id:null,
            'country_name'            => isset($this->country)?$this->country->$name:null,
            'country_id'              => isset($this->country)?$this->country->id:null,
            'city_name'               => isset($this->city)?$this->city->$name:null,
            'city_id'                 => isset($this->city)?$this->city->id:null,
            'block'                   => $this->block,
            'street'                  => $this->street,
            'block_num'               => $this->block_num,
            'delivery_time'           => $this->delivery_time,
            'signs'                   => $this->signs,
            'P_O_Box'                 => $this->P_O_Box,
            'ban'                     => $this->ban,



//            'nationality_id'      => $this->nationality->id,
//            'city'                => $this->city->$name,
//            'city_id'             => $this->city->id,
//            'token'               => $this->token->jwt,

        ];

    }
}
