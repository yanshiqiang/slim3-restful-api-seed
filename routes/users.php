<?php

/**
 * 
 */
use App\Controller\UserController;
use App\Controller\AuthController;

$App->group('/users', function() {
    $this->route(['GET'], '/{id}', UserController::class);
    $this->route(['DELETE', 'PUT'], '', AuthController::class);
    $this->route(['GET'], '', UserController::class, 'getAll');
});

/**
 * 
 */
use App\Controller\UserAdminController;
use App\Middleware\AdminMiddleware;

$App->group('/admin/users', function() {
    $this->route(['POST'], '', UserAdminController::class);
    $this->route(['DELETE', 'PUT'], '/{id}', UserAdminController::class);
})->add(new AdminMiddleware($container));
