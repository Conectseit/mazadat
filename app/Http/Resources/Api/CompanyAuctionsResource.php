<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAuctionsResource extends JsonResource
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
            'id'                          => $this->id,
            'serial_number'               => $this->serial_number,
            'name'                        => $this->$name,
            'image'                       => $this->first_image_path,
            'count_of_buyer'              => $this->count_of_buyer,
            'start_auction_price'         => $this->start_auction_price,
            'current_price'               => $this->current_price,
            'value_of_increment'          => (int)$this->value_of_increment,
//            'start_date'                  => $this->start_date,
            'start_date'                  => $this->start_date->format('l m-d-Y'),
            'end_date'                    => $this->end_date,
            'remaining_time'              => $this->remaining_time,
            'status'                      => $this->status,
            'is_unique'                   => $this->is_unique,

            'is_watched_auction'          => auth()->guard('api')->check() ? is_watched_auction($this->id) : false,

        ];

    }
}
