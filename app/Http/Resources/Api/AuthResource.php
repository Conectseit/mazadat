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
            'nationality'         => $this->nationality->$name,
            'city'                => $this->city->$name,
            'full_name'           => $this->full_name,
            'user_name'           => $this->user_name ,
            'email'               => $this->email,
            'mobile'              => $this->mobile,
            'bio'                 => $this->bio,
            'P_O_Box'             => $this->P_O_Box,
            'image'               => $this->image_path,
            'commercial_register_image' => $this->commercial_register_image_path,
            'token'               => $this->token->jwt,
        ];

    }
}
