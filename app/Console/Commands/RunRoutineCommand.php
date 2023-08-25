<?php

namespace App\Console\Commands;

use App\Enums\Routine;
use App\Services\ChecklistService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RunRoutineCommand extends Command {

    protected $signature = 'run:routines';
    protected $description = 'Executa o comando para Execução da rotina de verificação para execução de Criação e Processamento de Tarefas';

    public function handle(ChecklistService $checklistService) {
        $now = Carbon::now()->second(0)->millisecond(0);

        foreach (Routine::options() as $routineKey => $routineValue) {
            $runRoutine = '';
            try {
                $runRoutine = "execute" . $this->convertToCommand($routineKey);
                $this->$runRoutine($now, $checklistService);
            } catch (\Throwable $th) {
                Log::error('Erro ao Executar rotina: '.$th->getMessage());
            }
        }
    }

    private function executeTaskCreate(Carbon $time, ChecklistService $checklistService){
        echo "teste";
        $checklistService->processGenerateTasksChecklists();
    }

    private function executeTaskProccess(Carbon $time, ChecklistService $checklistService){
        echo "teste";
    }

    private function executeTaskRandomCreate(Carbon $time, ChecklistService $checklistService){
        echo "teste";
    }

    private function convertToCommand(string $str){
        $command = str_replace("_", "", ucwords(strtolower($str), " /_"));
        return $command;
    }
}
