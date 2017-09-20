<?php

namespace App\Http\Controllers\Api;

use App\AppMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AppMessage::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = AppMessage::create($request->all());

        return response()->json($message, 201)->header('Content-Type', env('API_CONTENT_TYPE'));
    }
}
