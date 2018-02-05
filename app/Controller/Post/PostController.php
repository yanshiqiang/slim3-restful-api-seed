<?php

namespace App\Controller\Post;

use App\Controller\Controller;
use App\Model\PostModel;
use App\Presenter\Post\PostPresenter;
use App\Presenter\Post\PostsPresenter;

/**
 * Class PostController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PostController extends Controller
{

    /**
     * Get a post.
     * 
     * @param mixed $id
     * @return Slim\Http\Response
     */
    public function get($id)
    {
        if (!$post = PostModel::find($id)) {
            return $this->respondWithError($this->text('post.not_found'));
        }

        return $this->respond((new PostPresenter($post))->present());
    }

    /**
     * Get all posts.
     * 
     * @return Slim\Http\Response
     */
    public function getAll()
    {
        $posts = PostModel::all();

        if (!$posts->count()) {
            return $this->respondWithError($this->text('post.not_found'));
        }

        return $this->respond((new PostsPresenter($posts))->present());
    }

}
