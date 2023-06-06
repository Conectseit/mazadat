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
//            'option_id'                   => $this->option_detail->option->id,
//            'name'                      => $this->$name,
            'option_name'                 => $this->option_detail->option->$name,
            'option_details_name'         => $this->option_detail->$value,
            'option_detail_id'            => $this->option_detail->id,
            'is_required'                 => $this->option_detail->option->is_required,

        ];
    }
}
