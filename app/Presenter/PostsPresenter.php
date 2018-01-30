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

    /**
     * 
     * @return array
     */
    public function format(): array
    {
        $data = [];

        $posts = $this->data();
        foreach ($posts as $post) {
            $data[] = (new PostPresenter($post))->format();
        }

        return $data;
    }

}
