<?php

namespace App\Interfaces;

use Interop\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interfaces
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
interface ContainerAwareInterface
{

    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     * @return void
     */
    public function setContainer(ContainerInterface $container);
}
