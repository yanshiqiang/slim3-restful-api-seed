<?php

namespace App\Interfaces;

use Interop\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 * 
 * @author Andrew Dyer
 * @category Interfaces
 * @see https://example.com
 */
interface ContainerAwareInterface
{

    public function setContainer(ContainerInterface $container);
}
