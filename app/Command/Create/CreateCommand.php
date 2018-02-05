<?php

namespace App\Command\Create;

use App\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CreateCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class CreateCommand extends Command
{

    /**
     * 
     * @return array
     */
    public function arguments(): array
    {
        return [
            ['type', InputArgument::REQUIRED, 'The type of resource; command, controller, middleware, model or presenter'],
            ['name', InputArgument::REQUIRED, 'The name of the resource.']
        ];
    }

    /**
     * 
     * @return string
     */
    public function description(): string
    {
        return 'Geneate a blank resource to build upon.';
    }

    /**
     * 
     * @return void
     */
    public function handle()
    {
        $type = $this->argument('type');
        $types = $this->config('app.directories');
        if (!array_key_exists($type, $types) or ! $type = $types[$type]) {
            return $this->writeError(sprintf('The resource type "%s" is invalid!', $type));
        }

        $fileParts = explode('\\', $this->argument('name'));
        $className = array_pop($fileParts) . $type['classPrefix'];
        $cleanPath = implode('/', $fileParts);

        $path = $type['classDir'];
        $namespace = $type['classNamespace'];
        if (count($fileParts) >= 1) {
            $path = $path . $cleanPath;
            $namespace = $namespace . '\\' . str_replace('/', '\\', $cleanPath);
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
        }

        $target = $path . '/' . $className . '.php';
        if (file_exists($target)) {
            return $this->writeError(sprintf('File "%s" already exists.', $target));
        }

        $replacements = [
            'ClassPlaceholder' => $className,
            'NamespacePlaceholder' => $namespace,
            'AuthorPlaceholder' => $this->option('author'),
            'EmailPlaceholder' => $this->option('email'),
            'SeePlaceholder' => $this->option('see')
        ];
        $template = str_replace(array_keys($replacements), $replacements, file_get_contents($type['classTemplate']));
        if (!file_put_contents($target, $template)) {
            return $this->writeError(sprintf('Unable to create file "%s".', $target));
        }

        return $this->writeInfo(sprintf('Successfully created "%s" in %s.', $className, $target));
    }

    /**
     * 
     * @return string
     */
    public function help(): string
    {
        return '';
    }

    /**
     * 
     * @return string
     */
    public function name(): string
    {
        return 'generate:resource';
    }

    /**
     * 
     * @return array
     */
    public function options(): array
    {
        return [
            ['author', 'a', InputOption::VALUE_OPTIONAL, 'The resource author.', env('DEV_AUTHOR')],
            ['email', 'e', InputOption::VALUE_OPTIONAL, 'The email address of the resource author.', env('DEV_AUTHOR_EMAIL')],
            ['see', 's', InputOption::VALUE_OPTIONAL, 'The link to the documentation for the resource.', env('DEV_DOCUMENTATION_LINK')],
        ];
    }

}
