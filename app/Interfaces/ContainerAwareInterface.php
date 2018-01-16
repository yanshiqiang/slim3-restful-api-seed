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

    public function setContainer(ContainerInterface $container);
}
