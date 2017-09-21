<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\AcceptHeader;

class VerifyContentType
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
        // Servers MUST respond with a 415 Unsupported Media Type status code if a request specifies
        // the header Content-Type: application/vnd.api+json with any media type parameters.

        $contentTypeHeader = AcceptHeader::fromString($request->header('content-type'))->get('application/vnd.api+json');

        if (empty($contentTypeHeader) || !empty($contentTypeHeader->getAttributes())) {
            return abort(415);
        }

        // Servers MUST respond with a 406 Not Acceptable status code if a request’s Accept header
        // contains the JSON API media type and all instances of that media type are modified with
        // media type parameters

        $acceptHeader = AcceptHeader::fromString($request->header('accept'))->get('application/vnd.api+json');

        if (!empty($acceptHeader) && !empty($acceptHeader->getAttributes())) {
            return abort(406);
        }

        return $next($request);
    }

}
