<?php

namespace App\Utility;

/**
 * Class Hash
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Utility
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class Hash
{

    public static function generate(string $string)
    {
        return hash("sha256", $string);
    }

    public static function salt(int $length = 32)
    {
        $salt = '';
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'\";:?.>,<!@#$%^&*()-_=+|';
        for ($x = 0; $x < $length; $x++) {
            $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
        }

        return $salt;
    }

    public static function unique()
    {
        return self::generate(uniqid());
    }

    public static function verify(string $known_string, string $string)
    {
        return $known_string === self::generate($string);
    }

}
