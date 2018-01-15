<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class UsersPresenter
 * 
 * @author Andrew Dyer
 * @category Presenter
 * @see https://example.com
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
