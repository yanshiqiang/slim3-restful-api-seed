<?php

namespace App\Interfaces;

/**
 * Interface CommandInterface
 * 
 * @author Andrew Dyer
 * @category Interfaces
 * @see https://example.com
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
