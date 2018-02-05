<?php

namespace App\Presenter\User;

use App\Presenter\Presenter;

/**
 * Class UserPresenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Presenter
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UserPresenter extends Presenter
{

    public function format(): array
    {
        $post = [];
        $post['id'] = $this->data()->id;
        $post['forename'] = $this->data()->forename;
        $post['surname'] = $this->data()->surname;
        $post['username'] = $this->data()->username;

        return $post;
    }

}
