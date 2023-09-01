<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\Cast\Array_;

class Functions
{

    public static function getTimeInMillis(): string
    {
        list($msec, $sec) = explode(' ', microtime());
        return $sec . substr($msec, 2, 3);
    }

    public static function nullOrEmpty($object): bool {
        if($object == null) return true;
        if($object instanceof Collection) return $object->count() == 0;
        if(is_array($object)) return sizeof($object) == 0;
        return empty($object);
    }


}
