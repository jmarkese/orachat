<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MessageResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "messages",
            "id" => (string) $this->id,
            "attributes" => $this->resource->toArray(),
            "links" => [
                "self" => route('messages.show', $this)
            ],
            "relations" => new SessionRelationshipResource($this->resource),
            "meta" => [],
        ];
    }
}
