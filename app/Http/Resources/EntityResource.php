<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'body' => $this->body,
            'body_plain' => $this->body_plain,
            'type' => $this->type,
            'start' => $this->start,
            'end' => $this->end
        ];
    }
}
