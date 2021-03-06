<?php

namespace App;

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

    /**
     * 
     * @param array $methods
     * @param string $pattern
     * @param string $className
     * @param string $methodName
     * @return Slim\Route
     */
    public function route(array $methods, string $pattern, string $className, string $methodName = '')
    {
        $callable = function($request, $response, $args) use ($className, $methodName) {
            $class = new $className($this, $request, $response);
            $method = $methodName ?: strtolower($request->getMethod());
            if (!method_exists($class, $method)) {
                throw new NotFoundException($request, $response);
            }
            
            return call_user_func_array([$class, $method], $args);
        };

        return $this->map($methods, $pattern, $callable);
    }

}
