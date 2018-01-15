<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class PostsPresenter
 * 
 * @author Andrew Dyer
 * @category Presenter
 * @see https://example.com
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
