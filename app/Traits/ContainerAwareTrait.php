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

    /** @var Interop\Container\ContainerInterface */
    private $_container;

    /**
     * 
     * @return Interop\Container\ContainerInterface
     */
    public function getContainer()
    {
        return $this->_container;
    }

    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     * @return void
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    /**
     * 
     * @param string $key
     * @return mixed
     */
    protected function config(string $key)
    {
        return $this->_container->config->get($key);
    }

    /**
     * 
     * @return object
     */
    protected function jwt()
    {
        return $this->_container->jwt;
    }

    /**
     * 
     * @return Monolog\Logger
     */
    protected function logger()
    {
        return $this->_container->logger;
    }

    /**
     * 
     * @return object
     */
    protected function user()
    {
        return $this->jwt()->data;
    }

    /**
     * 
     * @param string $key
     * @param string $default
     * @return string
     */
    protected function text(string $key, string $default = '')
    {
        if (!$text = $this->config('texts.' . $key)) {
            return $default;
        }

        return $text;
    }

}
