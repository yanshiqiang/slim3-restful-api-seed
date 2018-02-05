<?php

namespace App\Controller\Auth;

use App\Controller\Controller;
use App\Model\UserModel;
use App\Presenter\User\UserPresenter;
use App\Utility\Hash;
use Respect\Validation\Validator as v;

/**
 * Class RegisterController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class RegisterController extends Controller
{

    public function post()
    {
        $validation = $this->validate([
            'email' => v::notEmpty()->length(1, 254)->email()->emailUnique(),
            'forename' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'password' => v::notEmpty()->length(8, 100),
            'surname' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'username' => v::notEmpty()->length(1, 32)->noWhitespace()->alnum()->usernameUnique()
        ]);

        if (!$validation->passed()) {
            return $this->respondWithValidation($validation->errors());
        }

        $user = new UserModel;
        $user->email = $this->param('email');
        $user->forename = $this->param('forename');
        $user->salt = Hash::salt();
        $user->password = Hash::generate($this->param('password') . $user->salt);
        $user->surname = $this->param('surname');
        $user->username = $this->param('username');
        $user->save();

        return $this->respond((new UserPresenter($user))->present(), 201);
    }

}
