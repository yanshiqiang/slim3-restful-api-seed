<?php

namespace App;

use Slim\App as Slim;

/**
 * Class App
 * 
 * @author Andrew Dyer
 * @category App
 * @see https://example.com
 */
class App extends Slim
{

    public function route(array $methods, $pattern, $class, $method = '')
    {
        $callable = function($request, $response, $args) use ($class, $method) {
            $class = new $class($this, $request, $response);
            $method_name = strtolower($request->getMethod()) . ucfirst(strtolower($method));
            if (!method_exists($class, $method_name)) {
                throw new NotFoundException;
            }

            return call_user_func_array([$class, $method_name], $args);
        };

        return $this->map($methods, $pattern, $callable);
    }

}
