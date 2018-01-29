<?php

namespace App\Handler;

use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Handlers\Error;

/**
 * Class NotAllowedHandler
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Handler
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class NotAllowedHandler extends Error
{

    public function __invoke(Request $request, Response $response, Exception $exception)
    {
        return $response
            ->withStatus(405)
            ->withHeader('Content-Type', 'application/json')
            ->write('Something went wrong!');
    }

}
