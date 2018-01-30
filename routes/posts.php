<?php

use App\Controller\PostController;

$App->group('/posts', function() {
    $this->route(['POST'], '', PostController::class);
    $this->route(['GET'], '', PostController::class, 'getAll');
    $this->route(['DELETE', 'GET', 'PUT'], '/{id}', PostController::class);
});
