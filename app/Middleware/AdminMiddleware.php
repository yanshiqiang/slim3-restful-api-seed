<?php

namespace App\Middleware;

use App\Middleware\Middleware;
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

    /**
     * 
     * @param Psr\Http\Message\ServerRequestInterface $request
     * @param Psr\Http\Message\ResponseInterface $response
     * @param callable $next
     * @return Psr\Http\Message\ResponseInterface
     * @throws Slim\Exception\NotFoundException
     */
    public function handle(Request $request, Response $response, callable $next): Response
    {
        $userId = $this->user()->id;
        
        if (!$user = UserModel::find($userId)) {
            throw new NotFoundException($request, $response);
        }

        if (!($user->isAdmin() or $user->isSuperAdmin())) {
            throw new NotFoundException($request, $response);
        }

        $response = $next($request, $response);

        return $response;
    }

}
