<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class UserPresenter
 * 
 * @author Andrew Dyer
 * @category Presenter
 * @see https://example.com
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
