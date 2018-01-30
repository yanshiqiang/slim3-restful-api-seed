<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\UserModel;
use App\Utility\Hash;
use Firebase\JWT\JWT;

/**
 * Class LoginController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class LoginController extends Controller
{

    /**
     * 
     * @return Slim\Http\Response
     */
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
        $payload['exp'] = $payload['nbf'] + $this->config('jwt.ttl');
//        $payload['iss'] = '';
//        $payload['sub'] = '';
        $payload['data']['id'] = $user->id;

        $token = JWT::encode($payload, $this->config('jwt.secret'), $this->config('jwt.algorithm'));

        return $this->respond(json_encode(['token' => $token, 'expires' => $payload['exp']], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

}
