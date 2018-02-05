<?php

namespace App\Presenter\User;

use App\Presenter\Presenter;

/**
 * Class UsersPresenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Presenter
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UsersPresenter extends Presenter
{

    public function format(): array
    {
        $users = [];
        foreach ($this->data() as $user) {
            $users[] = (new UserPresenter($user))->format();
        }

        return $users;
    }

}
