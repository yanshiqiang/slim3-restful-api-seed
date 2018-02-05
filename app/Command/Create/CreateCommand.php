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
abstract class CreateCommand extends Command
{

    public function arguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the file']
        ];
    }

    public function handle()
    {
        $fileParts = array_map('ucfirst', explode('\\', $this->argument('name')));
        $className = array_pop($fileParts) . $this->classPrefix;
        $cleanPath = implode('/', $fileParts);

        $path = $this->classDir;
        $namespace = $this->classNamespace;
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
        $template = str_replace(array_keys($replacements), $replacements, file_get_contents($this->classTemplate));
        if (!file_put_contents($target, $template)) {
            return $this->writeError(sprintf('Unable to create file "%s".', $target));
        }

        return $this->writeInfo(sprintf('Successfully created "%s" in %s.', $className, $target));
    }

    public function options(): array
    {
        return [
            ['author', 'a', InputOption::VALUE_OPTIONAL, 'The resource author.', env('DEV_AUTHOR')],
            ['email', 'e', InputOption::VALUE_OPTIONAL, 'The email address of the resource author.', env('DEV_AUTHOR_EMAIL')],
            ['see', 's', InputOption::VALUE_OPTIONAL, 'The link to the documentation for the resource.', env('DEV_DOCUMENTATION_LINK')],
        ];
    }

}
