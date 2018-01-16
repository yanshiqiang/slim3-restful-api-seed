<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\UserModel;
use App\Presenter\UserPresenter;
use App\Presenter\UsersPresenter;
use App\Utility\Hash;
use Respect\Validation\Validator as v;

/**
 * Class UsersController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UsersController extends Controller
{

    /**
     * Delete a user.
     */
    public function delete($id)
    {
        if (!$user = UserModel::find($id)) {
            return $this->respondWithError($this->text('user.not_found'));
        }
        $user->delete();

        return $this->respondWithNoContent(202);
    }

    /**
     * Get a user.
     */
    public function get($id)
    {
        if (!$user = UserModel::find($id)) {
            return $this->respondWithError($this->text('user.not_found'));
        }

        return $this->respond((new UserPresenter($user))->present());
    }

    /**
     * Get all users.
     */
    public function getAll()
    {
        $users = UserModel::all();

        if (!$users->count()) {
            return $this->respondWithError($this->text('user.not_found'));
        }

        return $this->respond((new UsersPresenter($users))->present());
    }

    /**
     * Create a user.
     */
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

    /**
     * Update a user.
     */
    public function put($id)
    {
        if (!$user = UserModel::find($id)) {
            return $this->respondWithError($this->text('user.not_found'));
        }

        if (!$inputs = $this->inputs()) {
            return $this->respondWithError($this->text('user.nothing_to_update'), 400);
        }

        $validation = $this->validate([
            'email' => v::notEmpty()->length(1, 254)->email()->emailUnique($user->email),
            'forename' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'password' => v::notEmpty()->length(8, 100),
            'surname' => v::notEmpty()->length(1, 100)->noWhitespace()->alpha(),
            'username' => v::notEmpty()->length(1, 32)->noWhitespace()->alnum()->usernameUnique($user->username)
                ], $inputs);

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
