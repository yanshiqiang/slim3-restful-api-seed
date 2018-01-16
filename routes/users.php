<?php

use App\Controller\UsersController;

$App->group('/users', function() {
    $this->route(['POST'], '', UsersController::class);
    $this->route(['GET'], '', UsersController::class, 'getAll');
    $this->route(['DELETE', 'GET', 'PUT'], '/{id}', UsersController::class);
});
