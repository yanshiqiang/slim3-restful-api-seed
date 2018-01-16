<?php

namespace App;

use Exception;
use Slim\App as Slim;
use Slim\Exception\NotFoundException;

/**
 * Class App
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category App
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class App extends Slim
{

    public function route(array $methods, $pattern, $className, $methodName = '')
    {
        $callable = function($request, $response, $args) use ($className, $methodName) {
            $class = new $className($this, $request, $response);
            $method = $methodName ?: strtolower($request->getMethod());
            if (!method_exists($class, $method)) {
                die(sprintf('The method "%s" was not found', $method));
            }
            return call_user_func_array([$class, $method], $args);
        };

        return $this->map($methods, $pattern, $callable);
    }

}
