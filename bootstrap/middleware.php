<?php

$container = $App->getContainer();

// Cross-Origin Resource Sharing
use App\Middleware\CorsMiddleware;

$App->add(new CorsMiddleware($container));

// Json Response
use App\Middleware\JsonResponseMiddleware;

$App->add(new JsonResponseMiddleware($container));

// Jwt Authentication
use Slim\Middleware\JwtAuthentication;

$container['jwtAuthentication'] = function($container) {
    $jwt = $container->config->get('jwt');
    return new JwtAuthentication([
        'algorithm' => $jwt['algorithm'],
        'callback' => function ($request, $response, $arguments) use ($container) {
            $container['jwt'] = $arguments['decoded'];
        },
        'error' => function ($request, $response, $arguments) {
            $data['status'] = 'error';
            $data['message'] = $arguments['message'];
            $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

            return $response->withHeader('Content-Type', 'application/json')->write($body);
        },
        'passthrough' => $jwt['passthrough'],
        'path' => $jwt['path'],
        'relaxed' => $jwt['relaxed'],
        'secret' => $jwt['secret'],
        "secure" => $jwt['secure']
    ]);
};

$App->add($container->jwtAuthentication);
