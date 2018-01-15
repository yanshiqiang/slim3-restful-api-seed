<?php

namespace App\Presenter;

use App\Base\Presenter;

/**
 * Class PostPresenter
 * 
 * @author Andrew Dyer
 * @category Presenter
 * @see https://example.com
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
