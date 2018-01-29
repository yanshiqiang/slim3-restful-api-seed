<?php

use App\Controller\Admin\UsersController;
use App\Middleware\AdminMiddleware;

$App->group('/admin', function() {
    
    // Users
    $this->group('/users', function() {
        $this->route(['POST'], '', UsersController::class);
        $this->route(['GET'], '', UsersController::class, 'getAll');
        $this->route(['DELETE', 'GET', 'PUT'], '/{id}', UsersController::class);
    });
})->add(new AdminMiddleware($container));
