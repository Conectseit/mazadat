<?php

namespace App\Http\Resources\Api\auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AdditionalAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'person_latitude'      => isset($this->person_latitude)?(float)$this->person_latitude:24.7135517,
            'person_longitude'      => isset($this->person_longitude)?(float)$this->person_longitude:46.67529569,

        ];

    }
}
