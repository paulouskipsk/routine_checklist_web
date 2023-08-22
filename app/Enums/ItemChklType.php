<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum ItemChklType: string {
    use Options;

    case SIM_NAO = 'S';
    case AVALIATIVO = 'A';
    case TEXTUAL = 'T';
    case MULTIMIDIA = 'M';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(int $value): string {
        return match ($value) {
            'S' => 'Sim ou Não',
            'A' => 'Avaliativo',
            'T' => 'Textual',
            'M' => 'Multimidia'
        };
    }
}
