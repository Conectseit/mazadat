<?php

namespace App\Http\Resources\Api;

use App\Models\OptionDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryOptionsResource extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->$name,
            'is_required' => $this->is_required,
            'option_details'     => OptionDetailsResource::collection($this->option_details),

        ];
    }
}
