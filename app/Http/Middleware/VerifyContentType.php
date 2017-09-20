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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $contentTypeHeader = AcceptHeader::fromString($request->header('content-type'))->get('application/vnd.api+json');
        $acceptHeader = AcceptHeader::fromString($request->header('accept'))->get('application/vnd.api+json');

        // Servers MUST respond with a 415 Unsupported Media Type status code if a request specifies
        // the header Content-Type: application/vnd.api+json with any media type parameters.
        if (empty($contentTypeHeader) || !empty($contentTypeHeader->getAttributes())) {
            return response("Unsupported Media Type", 415);
        }

        // Servers MUST respond with a 406 Not Acceptable status code if a request’s Accept header
        // contains the JSON API media type and all instances of that media type are modified with
        // media type parameters
        if (!empty($acceptHeader) && !empty($acceptHeader->getAttributes())) {
            return response("Not Acceptable", 406);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return bool
     */
    protected function contentTypeHeaderValid(Request $request)
    {
        $contentType = AcceptHeader::fromString($request->header('content-type'));

        // also allowed to be multipart formdata and exceptional standard json
        if ($contentType->has('multipart/form-data') ||  $contentType->has('application/json')) {
            return true;
        }

        if ($contentType->has('application/vnd.api+json')) {
            $attributes = $contentType->get('application/vnd.api+json')->getAttributes();
            return (    empty($attributes)
                ||  (   count($attributes) === 1
                    &&  strtolower(array_get($attributes, 'charset')) === 'utf-8'
                )
            );
        }

        return false;
    }
}
