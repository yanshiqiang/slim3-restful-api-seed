<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class EmailUniqueException
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Validation
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class EmailUniqueException extends ValidationException
{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken.',
        ],
    ];

}
