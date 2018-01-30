<?php

namespace App\Controller;

use App\Base\Controller;
use App\Model\PostModel;
use App\Presenter\PostPresenter;
use Respect\Validation\Validator as v;

/**
 * Class PostAdminController
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Controller
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PostAdminController extends Controller
{

    /**
     * Delete a post.
     * 
     * @param mixed $id
     * @return Slim\Http\Response
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
     * Create a post.
     * 
     * @return Slim\Http\Response
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
     * 
     * @param mixed $id
     * @return Slim\Http\Response
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
