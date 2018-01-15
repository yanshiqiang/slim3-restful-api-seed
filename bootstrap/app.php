<?php

use App\App;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Illuminate\Database\Capsule\Manager as Capsule;
use Respect\Validation\Validator;

define('ROOT', realpath(dirname(__DIR__)) . '/');

require_once ROOT . 'vendor/autoload.php';

try {
    (new Dotenv(ROOT))->load();
} catch (InvalidPathException $ex) {
    die($ex->getMessage());
}

// Create new application
$App = new App([
    'settings' => [
        'displayErrorDetails' => env('APP_ENV') === 'production' ? false : true
    ]
]);

require_once ROOT . 'bootstrap/container.php';

// Capsule
$capsule = new Capsule;
$capsule->addConnection($container->config->get('database'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Validator
Validator::with("App\\Validation\\Rules\\");
