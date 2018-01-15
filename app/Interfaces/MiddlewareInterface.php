<?php

namespace App\Interfaces;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Interface MiddlewareInterface
 * 
 * @author Andrew Dyer
 * @category Interfaces
 * @see https://example.com
 */
interface MiddlewareInterface
{

    public function handle(Request $request, Response $response, $next): Response;
}
