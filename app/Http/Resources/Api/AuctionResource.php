<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $name = 'name_' . app()->getLocale();
//        $description = 'description_' . app()->getLocale();
        return [
            'name_ar'                 => $this->name_ar,
            'description_ar'                 => $this->description_ar,
            'image'                   => $this->first_image_path,
            'count_of_buyer'          => $this->count_of_buyer,
            'start_auction_price'         => $this->start_auction_price,
            'value_of_increment'          => $this->value_of_increment,
            'remaining_time'              => $this->remaining_time,
            'images'                   =>  AuctionImagesResource ::collection ($this->auctionimages),
        ];
    }
}
