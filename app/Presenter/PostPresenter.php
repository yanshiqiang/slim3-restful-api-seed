<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class PostPresenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Presenter
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PostPresenter extends Presenter
{

    public function format(): array
    {
        $post = [];
        $post['id'] = $this->data()->id;
        $post['title'] = $this->data()->title;
        $post['content'] = $this->data()->content;

        return $post;
    }

}
