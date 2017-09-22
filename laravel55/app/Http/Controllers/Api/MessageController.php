<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessagesResource;
use App\Message;
use Illuminate\Http\Request;
use App\Traits\JsonApiReponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageController extends Controller
{

    use JsonApiReponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        $resource = new MessagesResource(Message::with(['user'])->paginate());
        return $this->jsonApi($resource);
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
            'user_id' => 'required',
        ]);

        $message = \App\Message::create($request->all());
        return $this->jsonApi(new MessageResource($message));
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
