<?php

require_once realpath(dirname(__DIR__)) . '/bootstrap/app.php';

/**
 * Routes
 */
foreach (glob(ROOT . 'routes/*.php') as $route) {
    require_once $route;
}

/**
 * Middleware
 */
require_once ROOT . 'bootstrap/middleware.php';

$App->run();
