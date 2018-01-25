<?php

namespace App\Base;

use App\Interfaces\MiddlewareInterface;
use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class Middleware
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Middleware implements ContainerAwareInterface, MiddlewareInterface
{

    use ContainerAwareTrait;
    
    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * 
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     * @return Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        return $this->handle($request, $response, $next);
    }

}
