<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAuctionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = 'name_'.app()->getLocale();
        return [
            'serial_number'               => $this->serial_number,
            'name_ar'                     => $this->$name,
            'image'                       => $this->first_image_path,
            'count_of_buyer'              => $this->count_of_buyer,
            'start_auction_price'         => $this->start_auction_price,
            'current_price'               => $this->current_price,
            'value_of_increment'          => $this->value_of_increment,
            'start_date'                  => $this->start_date,
            'remaining_time'              => $this->remaining_time,
        ];

    }
}
