<?php

namespace App\Middleware;

use App\Base\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class JsonResponseMiddleware
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Middleware
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class JsonResponseMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, callable $next): Response
    {
        $response = $next($request, $response->withHeader('Content-Type', 'application/json'));        

        return $response;
    }

}
