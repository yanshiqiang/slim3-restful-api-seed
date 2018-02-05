<?php

use App\Controller\Auth\AuthController;
use App\Controller\Auth\RegisterController;

$App->group('/auth', function() {
    $this->route(['POST'], '/login', AuthController::class);
    $this->route(['POST'], '/register', RegisterController::class);
});
