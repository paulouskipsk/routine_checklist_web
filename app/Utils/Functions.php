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

    public static function inArray($value, Collection|array $array) {
        if($value instanceof Collection || is_array($value)){
            if($array instanceof Collection) {
                foreach ($value as $val) {
                    if($array->contains($val)) return true;
                }
            }else {
                foreach ($value as $val) {
                    if(in_array($val, $array)) return true;
                }
            }
        } else {
            if($array instanceof Collection) {
                if($array->contains($value)) return true;
            }else {
                if(in_array($value, $array)) return true;
            }
        }
        return false;
    }
}
