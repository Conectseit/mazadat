<?php

namespace App\Http\Resources\Api\auction;

use Illuminate\Http\Resources\Json\JsonResource;

class InspectionImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$name = 'name_'.app()->getLocale();
        return [
//            'image'                   => $this->image_path,
            'image'                   => $this->file_path,
            'file_id'                 => $this->file->id,
            'file_name'               => $this->file->name,
            'file_description'        => $this->description,
        ];

    }
}
