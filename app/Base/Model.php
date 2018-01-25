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

    /**
     * 
     * @param string $key
     * @return boolean
     */
    public function hasAttribute(string $key)
    {
        return array_key_exists($key, $this->attributes);
    }

}
