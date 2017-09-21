<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessagesResource;
use App\Message;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        return new MessagesResource(Message::with(['user'])->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = \App\Message::create($request->all());
        MessageResource::withoutWrapping();
        return (new MessageResource($message))
            ->response()
            ->header('Authorization', 'Bearer ' . $request->token)
            ->header('Contnent-type', 'application/vnd.api+json');
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
