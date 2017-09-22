<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            "type" => "users",
            "id" => (string)$this->resource->id,
            "attributes" => $this->resource->toArray(),
            "links" => [
                "self" => route('users.show', $this->resource)
            ],

        ];
    }
}
