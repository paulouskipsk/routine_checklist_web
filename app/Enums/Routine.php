<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum Routine: string {
    use Options;

    case TASK_CREATE = 'C';
    case TASK_PROCCESS = 'P';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(int $value): string {
        return match ($value) {
            'C' => 'Criar Tarefas Checklist',
            'P' => 'Processar Tarefas de Checklist',
        };
    }
}