<?php

namespace App\Interfaces;

/**
 * Interface PresenterInterface
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Interfaces
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
interface PresenterInterface
{

    /**
     * 
     * @return array
     */
    public function format(): array;
}
