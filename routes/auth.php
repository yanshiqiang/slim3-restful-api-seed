<?php

use App\Controller\AuthController;

$App->group('/auth', function() {
    $this->route(['POST'], '', AuthController::class);
});
