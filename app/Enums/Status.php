<?php

namespace App\Enums;

enum Status: string {

    case ACTIVE = 'A';
    case INACTIVE = 'I';
    case CANCELED = 'c';
    case BLOCKED = 'B';
    case NORMAL = 'N';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(string $value): string {
        return match ($value) {
            'A' => 'Ativo',
            'I' => 'Inativo',
            'C' => 'Cancelado',
            'B' => 'Bloqueado',
            'N' => 'Normal'
        };
    }
}
