<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $question = 'question_' . app()->getLocale();
        $replay = 'replay_' . app()->getLocale();
        return [
            'question'     => $this->$question,
            'replay'       => $this->$replay,
        ];

    }
}
