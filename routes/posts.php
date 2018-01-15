<?php

use App\Controller\PostsController;

$App->group('/posts', function() {
    $this->route(['POST'], '', PostsController::class);
    $this->route(['GET'], '', PostsController::class, 'all');
    $this->route(['DELETE', 'GET', 'PUT'], '/{id}', PostsController::class);
});
