<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\UserModel;
use App\Presenter\UserPresenter;
use App\Utility\Hash;
use Firebase\JWT\JWT;
use Respect\Validation\Validator as v;

/**
 * Class AuthController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class AuthController extends Controller
{

    /**
     * 
     * @return Slim\Http\Response
     */
    public function delete()
    {
        $userId = $this->user()->id;
        if (!$user = UserModel::find($userId)) {
            return $this->respondWithError($this->text('user.not_found'));
        }
        $user->delete();

        return $this->respondWithNoContent(202);
    }

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
        //$payload['iss'] = '';
        //s$payload['sub'] = '';
        $payload['data']['id'] = $user->id;

        $token = JWT::encode($payload, $this->config('jwt.secret'), $this->config('jwt.algorithm'));

        return $this->respond(json_encode(['token' => $token, 'expires' => $payload['exp']], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }

    /**
     * 
     * @return Slim\Http\Response
     */
    public function put()
    {
        $userId = $this->user()->id;
        if (!$user = UserModel::find($userId)) {
            return $this->respondWithError($this->text(''));
        }

        if (!$inputs = $this->inputs()) {
            return $this->respondWithError($this->text(''), 400);
        }

        $rules = [
            'email' => v::notEmpty()->length(1, 254)->email()->emailUnique($user->email),
            'forename' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'surname' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'username' => v::notEmpty()->length(1, 32)->noWhitespace()->alnum()->usernameUnique($user->username)
        ];

        $validation = $this->validate($rules, $inputs);

        if (!$validation->passed()) {
            return $this->respondWithValidation($validation->errors());
        }

        foreach ($inputs as $input) {
            if ($user->hasAttribute($input)) {
                $user->$input = $this->param($input);
            }
        }
        $user->save();

        return $this->respond((new UserPresenter($user))->present());
    }

}
