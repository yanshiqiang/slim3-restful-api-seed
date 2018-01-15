<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 * 
 * @author Andrew Dyer
 * @category Base
 * @see https://example.com
 */
abstract class Model extends BaseModel
{

    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

}
