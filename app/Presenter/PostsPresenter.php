<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class PostsPresenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Presenter
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PostsPresenter extends Presenter
{

    public function format(): array
    {
        $posts = [];
        foreach ($this->data() as $post) {
            $users[] = (new PostPresenter($post))->format();
        }

        return $posts;
    }

}
