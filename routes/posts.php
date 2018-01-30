<?php

/**
 * 
 */
use App\Controller\PostController;

$App->group('/posts', function() {
    $this->route(['GET'], '/{id}', PostController::class);
    $this->route(['GET'], '', PostController::class, 'getAll');
});

use App\Controller\PostAdminController;
use App\Middleware\AdminMiddleware;

/**
 * 
 */
$App->group('/admin/posts', function() {
    $this->route(['POST'], '', PostAdminController::class);
    $this->route(['DELETE', 'PUT'], '/{id}', PostAdminController::class);
})->add(new AdminMiddleware($container));
