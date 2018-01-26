<?php

// Cross-Origin Resource Sharing
use App\Middleware\CorsMiddleware;

$App->add(new CorsMiddleware($container));

// Json Response
use App\Middleware\JsonResponseMiddleware;

$App->add(new JsonResponseMiddleware($container));

// Jwt Authentication
use Slim\Middleware\JwtAuthentication;

$App->add(new JwtAuthentication([
    'algorithm' => env('JWT_ALGORITHM', 'HS256'),
    'callback' => function ($request, $response, $arguments) use ($container) {
        $container['jwt'] = $arguments['decoded'];
    },
    'error' => function ($request, $response, $arguments) {
        $data['status'] = 'error';
        $data['message'] = $arguments['message'];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $response->withHeader('Content-Type', 'application/json')->write($body);
    },
    'passthrough' => ['/auth'],
    'path' => '/',
    'relaxed' => ['localhost'],
    'secret' => env('JWT_SECRET'),
    "secure" => env('JWT_SECURE', true)
]));
