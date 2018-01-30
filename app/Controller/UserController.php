<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\UserModel;
use App\Presenter\UserPresenter;
use App\Presenter\UsersPresenter;

/**
 * Class UserController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UserController extends Controller
{

    /**
     * Get a user.
     * 
     * @param mixed $id
     * @return Slim\Http\Response
     */
    public function get($id)
    {
        if (!$user = UserModel::find($id)) {
            return $this->respondWithError($this->text('user.not_found'));
        }

        $user->giveAllPermissions();

        return $this->respond((new UserPresenter($user))->present());
    }

    /**
     * Get all users.
     * 
     * @return Slim\Http\Response
     */
    public function getAll()
    {
        $users = UserModel::all();

        if (!$users->count()) {
            return $this->respondWithError($this->text('user.not_found'));
        }

        return $this->respond((new UsersPresenter($users))->present());
    }

}
