<?php

namespace App\Http\Middleware;

use App\Http\Resources\ErrorAuthTokenResource;
use App\Traits\JsonApiReponse;
use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $status = 403;
                return response()->json(
                    [
                        'error' => [
                            'title' => "You cannot perform this action.",
                            "status" => (string)$status
                        ]
                    ], $status);
            }
            $request->request->add(['user_id' => $user->id]);
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException || $e instanceof TokenExpiredException) {
                $status = 401;
                return response()->json(
                    [
                        'error' => [
                            'title' => 'Unauthorized request or authorization failure.',
                            "status" => (string)$status
                        ]
                    ], $status);
            } else {
                return response()->json(['error' => ['title' => 'Something is wrong']]);
            }
        }
        return $next($request);
    }

}
