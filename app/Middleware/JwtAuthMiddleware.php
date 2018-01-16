<?php

namespace App\Middleware;

use App\Base\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Middleware\JwtAuthentication;

/**
 * Class JwtAuthMiddleware
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Middleware
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class JwtAuthMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, $next): Response
    {
        $jwt = $this->config('jwt');
        $jwtAuthentication = new JwtAuthentication([
            'path' => $jwt['path'],
            'passthrough' => $jwt['passthrough'],
            'algorithm' => $jwt['algorithm'],
            'logger' => $this->logger(),
            'secret' => $jwt['secret'],
            'relaxed' => $jwt['relaxed'],
            'error' => function ($request, $response, $arguments) {
                $data['status'] = 'error';
                $data['message'] = $arguments['message'];
                $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
                return $response->withHeader('Content-Type', 'application/json')->write($body);
            },
            'callback' => function ($request, $response, $arguments) {
                $this->jwt = $arguments['decoded'];
            }
        ]);

        $response = $jwtAuthentication($request, $response, $next);
        
        return $response;
    }

}
