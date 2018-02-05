<?php

namespace App\Presenter;

use App\Interfaces\PresenterInterface;

/**
 * Class Presenter
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Presenter
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Presenter implements PresenterInterface
{

    /** @var object */
    private $_data;

    /**
     * 
     * @param mixed $data
     */
    public function __construct($data = null)
    {
        $this->_data = (object) $data;
    }

    /**
     * 
     * @return object
     */
    protected function data()
    {
        return $this->_data;
    }

    /**
     * 
     * @return string
     */
    public function present()
    {
        return json_encode($this->format());
    }

}
