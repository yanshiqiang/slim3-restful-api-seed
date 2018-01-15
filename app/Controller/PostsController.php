<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\PostModel;
use App\Presenter\PostPresenter;
use App\Presenter\PostsPresenter;
use Respect\Validation\Validator as v;

/**
 * Class PostsController
 * 
 * @author Andrew Dyer
 * @category Controller
 * @see https://example.com
 */
class PostsController extends Controller
{

    /**
     * Delete a post.
     */
    public function delete($id)
    {
        if (!$post = PostModel::find($id)) {
            return $this->respondWithError($this->text('post.not_found'));
        }
        $post->delete();

        return $this->respondWithNoContent(202);
    }

    /**
     * Get a post.
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
     */
    public function getAll()
    {
        $posts = PostModel::all();

        if (!$posts->count()) {
            return $this->respondWithError($this->text('post.not_found'));
        }

        return $this->respond((new PostsPresenter($posts))->present());
    }

    /**
     * Create a post.
     */
    public function post()
    {
        $validation = $this->validate([
            'title' => v::notEmpty()->length(1, 160)
        ]);

        if (!$validation->passed()) {
            return $this->respondWithValidation($validation->errors());
        }

        $post = new PostModel;
        $post->title = $this->param('title');
        $post->content = $this->param('content');
        $post->save();

        return $this->respond((new PostPresenter($post))->present(), 201);
    }

    /**
     * Update a post.
     */
    public function put($id)
    {
        if (!$post = PostModel::find($id)) {
            return $this->respondWithError($this->text('post.not_found'));
        }

        if (!$inputs = $this->inputs()) {
            return $this->respondWithError($this->text('post.nothing_to_update'), 400);
        }

        $validation = $this->validate([
            'title' => v::notEmpty()->length(1, 160)
        ], $inputs);

        if (!$validation->passed()) {
            return $this->respondWithValidation($validation->errors());
        }

        foreach ($inputs as $input) {
            if ($post->hasAttribute($input)) {
                $post->$input = $this->param($input);
            }
        }
        $post->save();

        return $this->respond((new PostPresenter($post))->present());
    }

}
