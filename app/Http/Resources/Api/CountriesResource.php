<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CountriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        return [
            'id'               => $this->id,
            'name'             => $this->$name,
            'phone_code'       => $this->phone_code ,
        ];

    }
}
