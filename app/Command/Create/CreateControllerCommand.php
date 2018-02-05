<?php

namespace App\Command\Create;

/**
 * Class CreateControllerCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreateControllerCommand extends CreateCommand
{

    protected $classDir = ROOT . 'app/Controller/';
    protected $classNamespace = 'App\\Controller';
    protected $classPrefix = 'Controller';
    protected $classTemplate = ROOT . 'templates/controller.txt';

    public function description(): string
    {
        return '';
    }

    public function help(): string
    {
        return '';
    }

    public function name(): string
    {
        return 'create:controller';
    }

}
