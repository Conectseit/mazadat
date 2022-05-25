<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTransactionsResource extends JsonResource
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
            return [
                'payment_type'         => $this->payment_type,
                'amount'               => (int)$this->amount,
                'date'                 => $this->created_at->format('y/m/d'),
            ];

    }
}
