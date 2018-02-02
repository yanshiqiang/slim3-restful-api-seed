<?php

use App\Controller\AuthController;
use App\Controller\RegisterController;

$App->group('/auth', function() {
    $this->route(['POST'], '/login', AuthController::class);
    $this->route(['POST'], '/register', RegisterController::class);
});
