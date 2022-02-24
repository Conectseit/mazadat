<?php

namespace App\Http\Resources\Api\advertisement;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
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
            'image'            => $this->image_path ,
        ];

    }
}
