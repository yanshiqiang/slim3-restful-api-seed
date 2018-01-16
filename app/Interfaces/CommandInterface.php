<?php

namespace App\Interfaces;

/**
 * Interface CommandInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interfaces
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
interface CommandInterface
{

    public function arguments(): array;

    public function description(): string;

    public function handle();

    public function help(): string;

    public function name(): string;

    public function options(): array;
}
