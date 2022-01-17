<?php

namespace App\Http\Resources\Api\auction;

use Illuminate\Http\Resources\Json\JsonResource;

class auctionbuyersResource extends JsonResource
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
            'image'                   => $this->buyer->image_path,
            'full_name'                   => $this->buyer->full_name,
            'buyer_offer'                   => $this->buyer_offer,
        ];

    }
}
