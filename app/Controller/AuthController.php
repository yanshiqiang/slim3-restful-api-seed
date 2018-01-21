<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\UserModel;
use App\Utility\Hash;
use Firebase\JWT\JWT;

/**
 * Class AuthController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class AuthController extends Controller
{

    public function post()
    {
        $username = $this->param('username');
        $password = $this->param('password');

        if (!$user = UserModel::where('username', $username)->first()) {
            return $this->respondWithError('not found');
        }

        if (!Hash::verify($user->password, $password . $user->salt)) {
            return $this->respondWithError('wrong pass', 400);
        }

        $payload = [];
        $payload['iat'] = time();
        $payload['jti'] = base64_encode(random_bytes(32));
        $payload['nbf'] = $payload['iat'] + 10;
        $payload['exp'] = $payload['nbf'] + env('JWT_TOKEN_TTL');
//        $payload['iss'] = '';
//        $payload['sub'] = '';
        $payload['data']['id'] = $user->id;

        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        return $this->respond(json_encode(['token' => $token, 'expires' => $payload['exp']], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

}
