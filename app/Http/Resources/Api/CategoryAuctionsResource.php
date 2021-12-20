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
            'name_ar'                    => $this->$name,
            'image'                      => $this->first_image_path,
            'count_of_buyer'             => $this->count_of_buyer,
            'start_auction_price'         => $this->start_auction_price,
            'value_of_increment'          => $this->value_of_increment,
            'remaining_time'              => $this->remaining_time,
        ];

    }
}
