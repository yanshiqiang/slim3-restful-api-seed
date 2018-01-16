<?php

// Cross-Origin Resource Sharing
use App\Middleware\CorsMiddleware;

$App->add(new CorsMiddleware($container));

// Json Response
use App\Middleware\JsonResponseMiddleware;

$App->add(new JsonResponseMiddleware($container));

// Jwt Auth
use App\Middleware\JwtAuthMiddleware;

$App->add(new JwtAuthMiddleware($container));
