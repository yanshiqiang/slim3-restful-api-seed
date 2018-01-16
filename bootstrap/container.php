<?php

$container = $App->getContainer();

// Config
use Noodlehaus\Config;

$container['config'] = function() {
    return new Config(ROOT . 'config');
};

// Jwt
$container['jwt'] = function () {
    return new stdClass();
};

// Logger
use Monolog\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

$container['logger'] = function ($container) {
    $logger = new Logger('slim');
    $format = '[%datetime%] [%level_name%]: %message% %context%' . "\n";
    $formatter = new LineFormatter($format, null, true, true);
    $rotating = new RotatingFileHandler(ROOT . 'logs/slim.log', 0, Logger::DEBUG);
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};

// Validator
use App\Validation\Validator;

$container['validator'] = function() {
    return new Validator;
};
