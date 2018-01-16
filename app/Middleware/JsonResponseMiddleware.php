<?php

namespace App\Middleware;

use App\Base\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class JsonResponseMiddleware
 * 
 * @author Andrew Dyer
 * @category Middleware
 * @see https://example.com
 */
class JsonResponseMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, $next): Response
    {
        $response = $next($request, $response->withHeader('Content-Type', 'application/json'));        

        return $response;
    }

}
