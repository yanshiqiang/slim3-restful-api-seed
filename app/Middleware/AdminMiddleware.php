<?php

namespace App\Middleware;

use App\Base\Middleware;
use App\Model\UserModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\NotFoundException;

/**
 * Class AdminMiddleware
 *
 * @author John Doe <john.doe@example.com>
 * @category Middleware
 * @see https://example.com
 */
class AdminMiddleware extends Middleware
{

    public function handle(Request $request, Response $response, callable $next): Response
    {
        $userId = $this->jwt()->data->id;
        
        if (!$user = UserModel::find($userId)) {
            throw new NotFoundException($request, $response);
        }

        if (!$user->isAdmin()) {
            throw new NotFoundException($request, $response);
        }

        $response = $next($request, $response);

        return $response;
    }

}
