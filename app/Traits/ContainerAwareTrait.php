<?php

namespace App\Traits;

use Interop\Container\ContainerInterface;

/**
 * Trait ContainerAwareTrait
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Traits
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
trait ContainerAwareTrait
{

    private $_container;

    public function getContainer()
    {
        return $this->_container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->_container = $container;
        return $this;
    }

    protected function config($key)
    {
        return $this->_container->config->get($key);
    }

    protected function jwt()
    {
        return $this->_container->jwt;
    }

    protected function logger()
    {
        return $this->_container->logger;
    }

    protected function text(string $key, string $default = '')
    {
        if (!$text = $this->config('texts.' . $key)) {
            return $default;
        }

        return $text;
    }

    protected function data()
    {
        return $this->jwt()->data;
    }

}
