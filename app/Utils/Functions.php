<?php

namespace App\Utils;


class Functions
{

    public static function getTimeInMillis(): string
    {
        list($msec, $sec) = explode(' ', microtime());
        return $sec . substr($msec, 2, 3);
    }

    public static function nullOrEmpty($object): bool
    {
        return empty($object) || $object == null;
    }


}
