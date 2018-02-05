<?php

namespace App\Command\Create;

/**
 * Class CreatePresenterCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreatePresenterCommand extends CreateCommand
{

    protected $classDir = ROOT . 'app/Presenter/';
    protected $classNamespace = 'App\\Presenter';
    protected $classPrefix = 'Presenter';
    protected $classTemplate = ROOT . 'templates/presenter.txt';

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
        return 'create:presenter';
    }

}
