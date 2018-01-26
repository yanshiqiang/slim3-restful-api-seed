<?php

namespace App\Base;

use App\Interfaces\CommandInterface;
use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Command
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Command extends BaseCommand implements CommandInterface, ContainerAwareInterface
{

    use ContainerAwareTrait;

    /** @var Symfony\Component\Console\Input\InputInterface */
    private $_input;

    /** @var Symfony\Component\Console\Output\OutputInterface */
    private $_output;

    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->setContainer($container);
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    protected function argument(string $name)
    {
        return $this->_input->getArgument($name);
    }

    /**
     * 
     * @return void
     */
    protected function configure()
    {
        $this->setName($this->name());
        $this->setDescription($this->description());
        $this->setHelp($this->help());

        foreach ($this->arguments() as $argument) {
            if (is_array($argument) and count($argument) === 3) {
                $this->addArgument($argument[0], $argument[1], $argument[2]);
            }
        }

        foreach ($this->options() as $option) {
            if (is_array($option) and count($option) === 5) {
                $this->addOption($option[0], $option[1], $option[2], $option[3], $option[4]);
            }
        }
    }

    /**
     * 
     * @param Symfony\Component\Console\Input\InputInterface $input
     * @param Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_input = $input;
        $this->_output = $output;
        $this->handle();
    }

    /**
     * 
     * @return Symfony\Component\Console\Input\InputInterface
     */
    protected function input()
    {
        return $this->_input;
    }

    /**
     * 
     * @param string $name
     * @return mixed
     */
    protected function option(string $name)
    {
        return $this->_input->getOption($name);
    }

    /**
     * 
     * @return Symfony\Component\Console\Output\OutputInterface
     */
    protected function output()
    {
        return $this->_output;
    }

    /**
     * 
     * @param string $message
     * @return void
     */
    protected function writeComment(string $message)
    {
        $this->_output->writeln('<comment>' . $message . '</comment>');
    }

    /**
     * 
     * @param string $message
     * @return void
     */
    protected function writeError(string $message)
    {
        $this->_output->writeln('<error>' . $message . '</error>');
    }

    /**
     * 
     * @param string $message
     * @return void
     */
    protected function writeInfo(string $message)
    {
        $this->_output->writeln('<info>' . $message . '</info>');
    }

    /**
     * 
     * @param string $message
     * @return void
     */
    protected function writeQuestion(string $message)
    {
        $this->_output->writeln('<question>' . $message . '</question>');
    }

}
