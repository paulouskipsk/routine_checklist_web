<?php

namespace App\Utils;


class Functions {

    public static function getTimeInMillis(): string {
        list($msec, $sec) = explode(' ', microtime());
        return $sec.substr($msec, 2, 3);
     }
}