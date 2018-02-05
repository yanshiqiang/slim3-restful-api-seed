<?php

namespace App\Command\Create;

/**
 * Class CreateModelCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreateModelCommand extends CreateCommand
{

    protected $classDir = ROOT . 'app/Model/';
    protected $classNamespace = 'App\\Model';
    protected $classPrefix = 'Model';
    protected $classTemplate = ROOT . 'templates/model.txt';

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
        return 'create:model';
    }

}
