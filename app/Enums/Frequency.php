<?php

namespace App\Enums;
use ArchTech\Enums\Options;

enum Frequency: string {
    use Options;

    case DAILY = 'D';
    case WEEKLY = 'W';
    case FORTNIGHTLY = 'F';
    case MONTHLY = 'M';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(string $value): string {
        return match ($value) {
            'D' => 'Diário',
            'W' => 'Semanal',
            'F' => 'Quinzenal',
            'M' => 'Mensal',
        };
    }
}
