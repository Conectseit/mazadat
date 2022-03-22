<?php

namespace App\Http\Resources\Api\collections;

use App\Http\Resources\Api\auction\PendingAuctionsResource;
use App\Http\Resources\Api\CategoryAuctionsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MyPendingAuctionsCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'data' => PendingAuctionsResource::collection($this->collection),
            "links" => [
                "prev" => $this->previousPageUrl(),
                "next" => $this->nextPageUrl(),
            ],
            "meta" => [
                "current_page" => $this->currentPage(),
//                "from" => $this->firstItem(),
//                "to" => $this->lastItem(),
                "last_page" => $this->lastPage(),
                "per_page" => $this->perPage(),
                'count' => $this->count(), //count of items at current page
                "total" => $this->total() // count of all items
            ],
        ];
    }
}
