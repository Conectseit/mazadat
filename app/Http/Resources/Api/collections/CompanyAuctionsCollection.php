<?php

namespace App\Http\Resources\Api\collections;

use App\Http\Resources\Api\CompanyAuctionsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyAuctionsCollection extends ResourceCollection
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
            'data' => CompanyAuctionsResource::collection($this->collection),
            "links" => [
                "prev" => $this->previousPageUrl(),
                "next" => $this->nextPageUrl(),
            ],
            "meta" => [
                "current_page" => $this->currentPage(),
                "last_page" => $this->lastPage(), // not For Simple
                "per_page" => $this->perPage(),
                'count' => $this->count(), //count of items at current page
                "total" => $this->total() // not For Simple
            ],
        ];
        //return parent::toArray($request);
    }
}
