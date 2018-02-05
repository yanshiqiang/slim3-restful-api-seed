<?php

/**
 * 
 */
use App\Controller\User\UserController;
use App\Controller\AuthController;

$App->group('/users', function() {
    $this->route(['GET'], '/{id}', UserController::class);
    $this->route(['DELETE', 'PUT'], '', AuthController::class);
    $this->route(['GET'], '', UserController::class, 'getAll');
});

/**
 * 
 */
use App\Controller\Post\AdminUserController;
use App\Middleware\AdminMiddleware;

$App->group('/admin/users', function() {
    $this->route(['POST'], '', AdminUserController::class);
    $this->route(['DELETE', 'PUT'], '/{id}', AdminUserController::class);
})->add(new AdminMiddleware($container));
