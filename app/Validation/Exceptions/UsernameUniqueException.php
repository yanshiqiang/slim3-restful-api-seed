<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class UsernameUniqueException
 * @category Validation
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 */
class UsernameUniqueException extends ValidationException
{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Username is already taken.',
        ],
    ];

}
