<?php

namespace App\Http\Controllers\Api;

use App\AppSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = AppSession::create($request->all());

        return response()->json($session, 201);
    }
}
