<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuctionsResource extends JsonResource
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
        $description = 'description_' . app()->getLocale();
        if($this->auction->status=='on_progress'){
            return [
                'serial_number'               => $this->auction->serial_number,
                'name'                        => $this->auction->$name,
                'description'                 => $this->auction->$description,
                'image'                       => $this->auction->first_image_path,
                'count_of_buyer'              => $this->auction->count_of_buyer,
                'start_auction_price'         => $this->auction->start_auction_price,
                'current_price'               => $this->auction->current_price,
                'value_of_increment'          => $this->auction->value_of_increment,
                'start_date'                  => $this->auction->start_date,
                'remaining_time'              => $this->auction->remaining_time,
                'status'                      => $this->auction->status,
            ];
        }
        else return [];


//        return [
             //new AuctionResource ($this->auction),



//             $this->collection->transform(function ($q) {
//                return new AuctionResource($q->auction);
//            }),
//            "links" => [
//                "prev" => $this->previousPageUrl(),
//                "next" => $this->nextPageUrl(),
//            ],
//            "meta" => [
//                "current_page" => $this->currentPage(),
//                "from" => $this->firstItem(),
//                "to" => $this->lastItem(),
//                "last_page" => $this->lastPage(), // not For Simple
//                "per_page" => $this->perPage(),
//                'count' => $this->count(), //count of items at current page
//                "total" => $this->total() // not For Simple
//            ],
//        ];
    }
}
