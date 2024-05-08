<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum Status: string {
    use Options;

    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case CANCELED = 'C';
    case BLOCKED = 'B';
    case NORMAL = 'N';
    case CLOSED = 'F';
    case CLOSED_BY_SYSTEM = 'S';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(string $value): string {
        return match ($value) {
            'A' => 'Ativo',
            'I' => 'Inativo',
            'C' => 'Cancelado',
            'B' => 'Bloqueado',
            'N' => 'Normal',
            'F' => 'Fechado'
        };
    }
}
