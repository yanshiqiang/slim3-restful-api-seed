<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Model extends BaseModel
{

    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

}
