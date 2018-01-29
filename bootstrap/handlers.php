<?php

$container = $App->getContainer();

// Error Handler
use App\Handler\ErrorHandler;

$container['errorHandler'] = function () {
    return new ErrorHandler;
};

// Not Allowed Handler
use App\Handler\NotAllowedHandler;

$container['notAllowedHandler'] = function () {
    return new NotAllowedHandler;
};

// Not Found Handler
use App\Handler\NotFoundHandler;

$container['notFoundHandler'] = function () {
    return new NotFoundHandler;
};
