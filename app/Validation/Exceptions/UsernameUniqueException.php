<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class UsernameUniqueException
 * @category Validation
 * @see https://example.com
 * 
 * @author Andrew Dyer
 */
class UsernameUniqueException extends ValidationException
{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Username is already taken.',
        ],
    ];

}
