<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\auction\auctionbuyersResource;
use App\Http\Resources\Api\auction\InspectionImagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $name = 'name_' . app()->getLocale();
        $auction_terms = 'auction_terms_' . app()->getLocale();
        $description = 'description_' . app()->getLocale();
        return [
            'id'                          => $this->id,
            'serial_number'               => $this->serial_number,
            'name'                        => $this->$name,
            'description'                 => $this->$description,
            'image'                       => $this->first_image_path,
            'number_of_bids'              => $this->count_of_buyer,
            'start_auction_price'         => $this->start_auction_price,
            'current_price'               => $this->current_price,
            'value_of_increment'          =>(int) $this->value_of_increment,
            'start_date'                  => $this->start_date->format('l m-d-Y'),
            'end_date'                    => $this->end_date->format('Y-m-d TH:i:s'),

            'remaining_time'              => $this->remaining_time,
            'delivery_charge'             => $this->delivery_charge ,
            'is_unique'                   => $this->is_unique,
            'status'                      => $this->status,
            'seller_id'                   => $this->seller_id,
            'latitude'                    =>(float) $this->latitude,
            'longitude'                   => (float)$this->longitude,

            'is_watched_auction'          => auth()->guard('api')->check() ? is_watched_auction($this->id) : false,

//            'specifications'              => OptionResource::collection($this->options),
            'specifications'              => OptionResource::collection($this->auctiondata),

//            'inspection_report'           => $this->inspection_report_image_path,
            'Terms & Conditions'          => $this->$auction_terms,
            'images'                      =>  AuctionImagesResource ::collection ($this->auctionimages),
            'inspection_report'           =>  InspectionImagesResource ::collection ($this->inspectionimages),
            'buyers'                      =>  auctionbuyersResource ::collection ($this->auctionbuyers),
        ];
    }
}
