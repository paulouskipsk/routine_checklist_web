<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum ChklFrequency: string {
    use Options;

    case DIARIO = 'DIA';
    case SEMANAL = 'SEM';
    case QUINZENAL = 'QUI';
    case MENSAL = 'MEN';

    public function descricao(): string {
        return static::getDescricao($this->value);
    }

    public static function getDescricao(int $tipoTarefa): string {
        return match ($tipoTarefa) {
            'DIA' => 'Diário',
            'SEM' => 'Semanal',
            'QUI' => 'Quinzenal',
            'MEN' => 'Mensal'
        };
    }
}
