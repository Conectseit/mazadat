<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'title'         => $this->title,
            'text'          => $this->text,
            'is_seen'       => $this->is_seen,
            'send_at'       => $this->created_at->diffForHumans(),
        ];

    }
}
