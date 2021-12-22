<?php

namespace App\Http\Resources\Api;

use App\Models\OptionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $value = 'value_' . app()->getLocale();
        return [
            'id'       => $this->id,
            'value'     => $this->$value,
        ];
    }
}
