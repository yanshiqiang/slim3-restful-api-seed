<?php

namespace App\Middleware;

use App\Middleware\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class CorsMiddleware
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Middleware
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CorsMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, callable $next): Response
    {
        $response = $next($request, $response
                        ->withHeader('Access-Control-Allow-Origin', $this->config('app.domain'))
                        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'));

        return $response;
    }

}
