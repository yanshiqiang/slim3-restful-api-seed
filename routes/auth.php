<?php

use App\Controller\LoginController;
use App\Controller\RegisterController;

$App->group('/auth', function() {
    $this->route(['POST'], '/login', LoginController::class);
    $this->route(['POST'], '/register', RegisterController::class);
});
