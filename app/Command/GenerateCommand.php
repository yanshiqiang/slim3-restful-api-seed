<?php

namespace App\Command;

use App\Base\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class GenerateCommand
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Command
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 * @au
 */
class GenerateCommand extends Command
{

    public function arguments(): array
    {
        return [
            ['type', InputArgument::REQUIRED, 'The type of resource; command, controller, middleware, model or presenter'],
            ['name', InputArgument::REQUIRED, 'The name of the resource.']
        ];
    }

    public function description(): string
    {
        return 'Geneate a blank resource to build upon.';
    }

    public function handle()
    {
        $type = $this->argument('type');
        $types = $this->config('app.directories');
        if (!array_key_exists($type, $types) or ! $type = $types[$type]) {
            return $this->error(sprintf('The resource type "%s" is invalid!', $type));
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
            return $this->error(sprintf('File "%s" already exists.', $target));
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
            return $this->error(sprintf('Unable to create file "%s".', $target));
        }

        return $this->info(sprintf('Successfully created "%s" in %s.', $className, $target));
    }

    public function help(): string
    {
        return '';
    }

    public function name(): string
    {
        return 'generate:resource';
    }

    public function options(): array
    {
        return [
            ['author', 'a', InputOption::VALUE_OPTIONAL, 'The resource author.', 'John Doe'],
            ['email', 'e', InputOption::VALUE_OPTIONAL, 'The email address of the resource author.', 'john.doe@example.com'],
            ['see', 's', InputOption::VALUE_OPTIONAL, 'The link to the documentation for the resource.', 'https://example.com'],
        ];
    }

}
