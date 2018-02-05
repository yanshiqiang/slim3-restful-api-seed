<?php

/**
 * 
 */
use App\Controller\Post\PostController;

$App->group('/posts', function() {
    $this->route(['GET'], '/{id}', PostController::class);
    $this->route(['GET'], '', PostController::class, 'getAll');
});

use App\Controller\Post\AdminPostController;
use App\Middleware\AdminMiddleware;

/**
 * 
 */
$App->group('/admin/posts', function() {
    $this->route(['POST'], '', AdminPostController::class);
    $this->route(['DELETE', 'PUT'], '/{id}', AdminPostController::class);
})->add(new AdminMiddleware($container));
