<?php

namespace App\Command\Create;

/**
 * Class CreateMiddlewareCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreateMiddlewareCommand extends CreateCommand
{

    protected $classDir = ROOT . 'app/Middleware/';
    protected $classNamespace = 'App\\Middleware';
    protected $classPrefix = 'Middleware';
    protected $classTemplate = ROOT . 'templates/middleware.txt';

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
        return 'create:middleware';
    }

}
