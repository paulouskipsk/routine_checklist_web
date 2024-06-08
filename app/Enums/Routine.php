<?php

namespace App\Enums;

use ArchTech\Enums\Options;

enum Routine: string {
    use Options;
    case TASK_CREATE = 'C';
    case FINISH_EXPIRED_TASKS = 'F';

    public function description(): string {
        return static::getDescription($this->value);
    }

    public static function getDescription(int $value): string {
        return match ($value) {
            'C' => 'Criar Tarefas Checklist',
            'F' => 'Finalizar Tarefas de Checklists Expiradas',
        };
    }
}