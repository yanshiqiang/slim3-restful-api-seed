<?php

namespace App\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Interface MiddlewareInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interfaces
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
interface MiddlewareInterface
{

    /**
     * 
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     * @return Psr\Http\Message\ResponseInterface
     */
    public function handle(Request $request, Response $response, callable $next): Response;
}
