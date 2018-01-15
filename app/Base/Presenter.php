<?php

namespace App\Base;

use App\Interfaces\PresenterInterface;

/**
 * Class Presenter
 * 
 * @author Andrew Dyer
 * @category Base
 * @see https://example.com
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
