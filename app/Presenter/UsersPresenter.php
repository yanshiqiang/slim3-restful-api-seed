<?php

namespace App\Presenter;

use App\Base\Presenter;

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
