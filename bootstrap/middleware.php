<?php

// Cross-Origin Resource Sharing
use App\Middleware\CorsMiddleware;

$App->add(new CorsMiddleware($container));

// Json Response
use App\Middleware\JsonResponseMiddleware;

$App->add(new JsonResponseMiddleware($container));
