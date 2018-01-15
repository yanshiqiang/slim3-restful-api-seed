<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class EmailUniqueException
 * 
 * @author Andrew Dyer
 * @category Validation
 * @see https://example.com
 */
class EmailUniqueException extends ValidationException
{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken.',
        ],
    ];

}
