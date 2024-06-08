<?php

namespace App\Console\Commands;

use App\Enums\Status;
use App\Models\ChecklistMov;
use App\Services\ChecklistMovService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FinishChecklistsRoutine extends Command {
    protected $signature = 'routine:finish-checklists';
    protected $description = 'Finaliza automaticamente, os checklists expirados por tempo e que não foram finalizados manualmente';

    public function handle() {
        try {
            //Finaliza tarefas expiradas a cada 10 minutos
            if(Carbon::now()->minute() % 10 != 0) return;

            Log::info("ROTINA AUTOMATICA: Finalizando automaticamente os checklists expirados pelo shelflife.");
            $checklistMovServ = new ChecklistMovService();
            $checklists = ChecklistMov::where('end_date', '<', Carbon::now())
                                      ->where('status', Status::ACTIVE)
                                      ->get();

            foreach ($checklists as $chechlist) {
                $checklistMovServ->closeChecklistMov($chechlist, true);
            }
            Log::info("ROTINA AUTOMATICA: Finalizado automaticamente: ". $checklists->count(). " checklists expirados pelo shelflife.");
        } catch (\Throwable $th) {
            Log::error("ROTINA AUTOMATICA: Erro ao finalizar os Checklists Expirados pelo shelflife. Erro: ". $th->getMessage(). ", Arquivo: ".$th->getFile(). ', Linha: '.$th->getLine() );
        }
    }
}
