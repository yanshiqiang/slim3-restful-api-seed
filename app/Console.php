<?php

namespace App;

use App\Traits\ContainerAwareTrait;
use App\Interfaces\ContainerAwareInterface;
use Symfony\Component\Console\Application;
use Interop\Container\ContainerInterface;

/**
 * Class Console
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category App
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class Console extends Application implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /** @var Interop\Container\ContainerInterface */
    private $_commands;

    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->setContainer($container);
        $this->_commands = $this->config('commands');
    }

    /**
     * 
     * @return App\Console
     */
    public function boot()
    {
        if (is_array($this->_commands)) {
            foreach ($this->_commands as $command) {
                if (!class_exists($command)) {
                    $this->logger()->warning(sprintf('Command "%s" was not found!', $command));
                    break;
                }
                $this->add(new $command($this->_container));
            }
        }
        
        return $this;
    }

}
