<?php

namespace App\Presenter\Post;

use App\Presenter\Presenter;

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
