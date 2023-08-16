<?php

namespace App\Enums;
use ArchTech\Enums\Options;

enum DaysOfWeeak: int {
    use Options;

    case SUNDAY = 0;
    case MONDAY = 1;
    case TUESDAY = 2;
    case WEDNESDAY = 3;
    case THURSDAY = 4;
    case FRIDAY = 5;
    case SATURDAY = 6;


    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(string $value): string {
        return match ($value) {
            0 => 'Domingo',
            1 => 'Segunda-Feira',
            2 => 'Tareça-Feira',
            3 => 'Quarta-Feira',
            4 => 'Quinta-Feira',
            5 => 'Sexta-Feira',
            6 => 'Sábado',
        };
    }
}
