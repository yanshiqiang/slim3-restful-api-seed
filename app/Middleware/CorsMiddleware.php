<?php

namespace App\Middleware;

use App\Base\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class CorsMiddleware
 * 
 * @author Andrew Dyer
 * @category Middleware
 * @see https://example.com
 */
class CorsMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, $next): Response
    {
        $response = $next($request, $response
                        ->withHeader('Access-Control-Allow-Origin', $this->config('app.domain'))
                        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'));

        return $response;
    }

}
