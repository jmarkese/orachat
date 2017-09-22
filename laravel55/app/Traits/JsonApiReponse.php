<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Tymon\JWTAuth\Facades\JWTAuth;


trait JsonApiReponse
{

    public function jsonApi($resource, $token = null)
    {
        $token = $token ?: JWTAuth::getToken();
        return $resource
            ->response()
            ->header('Authorization', 'Bearer ' . $token)
            ->header('Content-Type', 'application/vnd.api+json');
    }

}