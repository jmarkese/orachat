<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class SessionResource extends Resource
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
            "type" => "sessions",
            "id" => (string)$this->id,
            "attributes" => [
                "created_at" => Carbon::now()->toIso8601String()
            ],
            "links" => [
                "self" => route('messages.show', $this)
            ],
            "relations" => new SessionRelationshipResource($this->resource),
            "meta" => [],
        ];
    }

    /**
     * Get any additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        $included = new UserResource($this->resource);

        return [
            'included' => $included,
        ];
    }
}
