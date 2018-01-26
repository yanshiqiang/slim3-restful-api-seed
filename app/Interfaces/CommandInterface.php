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

    /**
     * 
     * @return array
     */
    public function arguments(): array;

    /**
     * 
     * @return string
     */
    public function description(): string;

    /**
     * 
     * @return mixed
     */
    public function handle();

    /**
     * 
     * @return string
     */
    public function help(): string;

    /**
     * 
     * @return string
     */
    public function name(): string;

    /**
     * 
     * @return array
     */
    public function options(): array;
}
