<?php

namespace App\Http\Resources\Api\auction;

use App\Http\Resources\Api\auction\InspectionImagesResource;
use App\Http\Resources\Api\AuctionImagesResource;
use App\Http\Resources\Api\OptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PendingAuctionsResource extends JsonResource
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
            'name_ar'                     => $this->name_ar,
            'name_en'                     => $this->name_en,
            'start_auction_price'         => $this->start_auction_price,
            'value_of_increment'          => (int)$this->value_of_increment,
//            'category_id'                 => $this->category_id,

            'category'                   => ['id' => isset($this->category_id)?$this->category_id:'null',
                                            'name' => isset($this->category_id)?$this->category->$name:'null', ],
            'description_ar'              => $this->description_ar,
            'description_en'              => $this->description_en,
            'auction_terms_ar'            => $this->auction_terms_ar,
            'auction_terms_en'            => $this->auction_terms_en,
            'latitude'                    => $this->latitude,
            'longitude'                   => $this->longitude,
            'allowed_take_photo'          => $this->allowed_take_photo,
            'specifications'              => OptionResource::collection($this->auctiondata),
            'images'                      =>  AuctionImagesResource ::collection ($this->auctionimages),
            'inspection_report'           =>  InspectionImagesResource ::collection ($this->inspectionimages),

        ];

    }
}
