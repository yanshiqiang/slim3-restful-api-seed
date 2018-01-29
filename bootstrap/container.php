<?php

$container = $App->getContainer();

// Config
use Noodlehaus\Config;

$container['config'] = function() {
    return new Config(ROOT . 'config');
};

// Jwt
$container['jwt'] = function () {
    return new \stdClass();
};

// Jwt Authentication
use Slim\Middleware\JwtAuthentication;

$container['jwtAuthentication'] = function($container) {
    $jwt = $container->config->get('jwt');
    return new JwtAuthentication([
        'algorithm' => $jwt['algorithm'],
        'callback' => function ($request, $response, $arguments) use ($container) {
            $container['jwt'] = $arguments['decoded'];
        },
        'error' => function ($request, $response, $arguments) {
            $data['status'] = 'error';
            $data['message'] = $arguments['message'];
            $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

            return $response->withHeader('Content-Type', 'application/json')->write($body);
        },
        'passthrough' => $jwt['passthrough'],
        'path' => $jwt['path'],
        'relaxed' => $jwt['relaxed'],
        'secret' => $jwt['secret'],
        "secure" => $jwt['secure']
    ]);
};

$App->add($container->jwtAuthentication);

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
