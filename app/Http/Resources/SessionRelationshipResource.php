<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SessionRelationshipResource extends Resource
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
            'creator' => [
                'links' => [
                    'self' => route('sessions.relationships.creator', ['sessions' => $this->id]),
                    'related' => route('sessions.creator', ['sessions' => $this->id]),
                ],
                'data' => new UserResource($this->resource),
            ],
        ];
    }
}
