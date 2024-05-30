<?php

namespace App\Utils;

use App\Models\ChecklistItemMov;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Expr\Cast\Array_;
use PhpParser\Node\Expr\Cast\Double;

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
    public static function getResponseText(string|null $response) {
        return match ($response) {
            'Y' => 'Sim',
            'N' => 'Não',
            'B' => 'Ruim',
            'G' => 'Bom',
            'E' => 'Excelente',
            default => 'Não Informado',
        };
    }

    public static function getScoreExecution(ChecklistItemMov $checklistItemMov): float {
        if(self::nullOrEmpty($checklistItemMov->score) ||$checklistItemMov->score <= 0) return 0;

        return match ($checklistItemMov->response) {
            'Y' => $checklistItemMov->score,
            'G' => $checklistItemMov->score / 2,
            'E' => $checklistItemMov->score,
            default => 0
        };
    }

    /**
     * Converte varios formatos de data em string para carbon
     * @param $date String com a data a ser convertida
     * @return Carbon|Exception
     */
    public static function convertDateToCarbon($date) {
        if ($date == null) return $date;
        
        if ($date instanceof Carbon) return $date;

        if (Carbon::hasFormat($date, 'd/m/Y')) {
            $date = Carbon::createFromFormat('d/m/Y', $date);
        } else if (Carbon::hasFormat($date, 'd/m/Y H:i:s.u')) {
            $date = Carbon::createFromFormat('d/m/Y H:i:s.u', $date);
        } else if (Carbon::hasFormat($date, 'Y-m-d')) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
        } else if (Carbon::hasFormat($date, 'Y-m-d H:i:s.u')) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s.u', $date);
        } else if (Carbon::hasFormat($date, 'Y-m-d H:i:s')) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
        } else if (Carbon::hasFormat($date, 'd-m-Y')) {
            $date = Carbon::createFromFormat('d-m-Y', $date);
        } else if (Carbon::hasFormat($date, 'd-m-Y H:i:s.u')) {
            $date = Carbon::createFromFormat('d-m-Y H:i:s.u', $date);
        } else {
            throw new Exception("Erro ao Converter Data $date");
        }
        return $date;
    }

    public static function FormatDate(string|Date|DateTime|Carbon|null $date, string $pattern) {
        $date = self::convertDateToCarbon($date);
        if ($date == null) return $date;

        return $date->format($pattern);
    }

    public static function formatPrice(string|double|null $price, int $precision): string {
        try {
            $price = self::nullOrEmpty($price) ? 0 : $price;
            $price = $price instanceof double ? $price : doubleval($price);
            $price = number_format($price, $precision, ',', '');
            return $price;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
