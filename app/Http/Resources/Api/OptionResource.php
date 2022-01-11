<?php

namespace App\Http\Resources\Api;

use App\Models\OptionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
        $value = 'value_' . app()->getLocale();
        return [
            'id'                 => $this->id,
            'name'               => $this->$name,
//            'option_details'     => ($this->option_details->$value),
        ];
    }
}
