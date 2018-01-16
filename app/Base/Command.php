<?php

namespace App\Base;

use App\Interfaces\CommandInterface;
use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Interop\Container\ContainerInterface;

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

    private $_input, $_output;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();

        $this->setContainer($container);
    }

    protected function argument($name)
    {
        return $this->_input->getArgument($name);
    }

    protected function comment($value)
    {
        $this->_output->writeln('<comment>' . $value . '</comment>');
    }

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

    protected function error($value)
    {
        $this->_output->writeln('<error>' . $value . '</error>');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->_input = $input;
        $this->_output = $output;
        $this->handle();
    }

    protected function info($value)
    {
        $this->_output->writeln('<info>' . $value . '</info>');
    }

    protected function input()
    {
        return $this->_input;
    }

    protected function option($name)
    {
        return $this->_input->getOption($name);
    }

    protected function output()
    {
        return $this->_output;
    }

    protected function question($value)
    {
        $this->_output->writeln('<question>' . $value . '</question>');
    }

}
