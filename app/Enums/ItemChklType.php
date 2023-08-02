<?php

namespace App\Enums;

enum ItemChklType: string {

    case SIM_NAO = 'S';
    case AVALIATIVO = 'A';
    case TEXTUAL = 'T';
    case MULTIMIDIA = 'M';

    public function descricao(): string {
        return static::getDescricao($this->value);
    }

    public static function getDescricao(int $tipoTarefa): string {
        return match ($tipoTarefa) {
            'S' => 'Sim ou Não',
            'A' => 'Avaliativo',
            'T' => 'Textual',
            'M' => 'Multimidia'
        };
    }
}
