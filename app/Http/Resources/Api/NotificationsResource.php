<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'title'         => $this->title,
            'text'          => $this->text,
            'auction'    => [
                'id' => isset($this->auction_id)?$this->auction_id:null,
                'image' => isset($this->auction->first_image_path)?$this->auction->first_image_path:null, // url full
            ],
            'is_seen'       => $this->is_seen,
            'send_at'       => $this->created_at->diffForHumans(),
        ];
    }
}
