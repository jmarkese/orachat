<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Traits\JsonApiReponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SessionController extends Controller
{

    use JsonApiReponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = \App\User::create($request->all());
        $token = JWTAuth::fromUser($user);

        return $this->jsonApi(new SessionResource($user), $token);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function show(User $id)
    {
        // @TODO
    }
}
