<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MessageRelationshipResource extends Resource
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
                    'self' => route('messages.relationships.creator', ['messages' => $this->id]),
                    'related' => route('messages.creator', ['messages' => $this->id]),
                ],
                'data' => new UserResource($this->user),
            ],
        ];
    }
}
