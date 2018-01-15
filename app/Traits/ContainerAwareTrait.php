<?php

namespace App\Traits;

use Interop\Container\ContainerInterface;

/**
 * Trait ContainerAwareTrait
 * 
 * @author Andrew Dyer
 * @category Traits
 * @see https://example.com
 */
trait ContainerAwareTrait
{

    private $_container;

    public function setContainer(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    protected function config($key)
    {
        return $this->_container->config->get($key);
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

}
