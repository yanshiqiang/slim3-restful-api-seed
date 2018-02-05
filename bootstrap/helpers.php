<?php

if (!function_exists('envStringToArray')) {

    function envStringToArray($string)
    {
        return array_filter(array_map('trim', explode(',', $string)));
    }

}