<?php

namespace App\Base;

use App\Interfaces\PresenterInterface;

/**
 * Class Presenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Presenter implements PresenterInterface
{

    private $_data;

    public function __construct($data = null)
    {
        $this->_data = (object) $data;
    }

    protected function data()
    {
        return $this->_data;
    }

    public function present()
    {
        return json_encode($this->format());
    }

}
