<?php

namespace App\Console\Commands;

use App\Enums\Routine;
use App\Services\ChecklistMovService;
use App\Services\ChecklistService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class RunRoutineCommand extends Command {

    protected $signature = 'run:routines';
    protected $description = 'Executa o processamento de tarefas automatizado';

    public function handle() {
        $now = Carbon::now()->second(0)->millisecond(0);
        foreach (Routine::options() as $routineKey => $routineValue) {
            $runRoutine = '';
            try {
                $runRoutine = "execute" . $this->convertToCommand($routineKey);
                $this->$runRoutine($now);
            } catch (\Throwable $th) {
                Log::error('Erro ao Executar rotina: '.$th->getMessage());
            }
        }
    }

    private function convertToCommand(string $str){
        $command = str_replace("_", "", ucwords(strtolower($str), " /_"));
        return $command;
    }

    private function executeTaskCreate(Carbon $time){
        $checklistService = App::make(ChecklistService::class);
        $checklistService->processGenerateTasksChecklists();
    }

    private function executeFinishExpiredTasks(Carbon $time){
        $checklistMovService = App::make(ChecklistMovService::class);
        $checklistMovService->finishExpiredTasks($time);
    }
}
