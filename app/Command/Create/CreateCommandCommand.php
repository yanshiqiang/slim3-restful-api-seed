<?php

namespace App\Command\Create;

/**
 * Class CreateCommandCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreateCommandCommand extends CreateCommand
{

    protected $classDir = ROOT . 'app/Command/';
    protected $classNamespace = 'App\\Command';
    protected $classPrefix = 'Command';
    protected $classTemplate = ROOT . 'templates/command.txt';

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
        return 'create:command';
    }

}
