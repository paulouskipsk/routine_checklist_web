<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Services\ChecklistItemMovService;
use App\Services\ChecklistMovService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistItemMovControllerApi extends ControllerApi {

    public function getChecklistsItensMovs(Request $request){
        try {
            $checklistItensMovs= ChecklistItemMov::with('sector')
                                                 ->whereStatus(Status::ACTIVE)
                                                 ->whereChmvId($request->chmv_id)
                                                 ->whereProcessed('N')
                                                 ->orderBy('sequence')
                                                 ->get();

            return $this->responseOk("Perguntas do Checklist Pesquisados com sucesso.", ['checklistsItensMovs'=> $checklistItensMovs]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao Buscar Tarefas de Checklist"+ $th->getMessage());
        }
    }

    public function responseChecklistItemMov(Request $request){
        try {
            $serv = new ChecklistItemMovService();
            $checklistItemMov = $serv->answerQuestion($request, Auth::user());

            $itensPendentes = ChecklistItemMov::where('chmv_id', $checklistItemMov->chmv_id)
                                                ->where('processed', 'N')
                                                ->where('status', 'A')
                                                ->count();
            if($itensPendentes == 0){
                $checklistMovServ = new ChecklistMovService();
                $checklistMovServ->closeChecklistMov($checklistItemMov->checklistMov);
                return $this->response(true, 201, "Todas as perguntas foram respondidas, Checklist finalizado, Parabéns!");
            }

            return $this->responseOk("Resposta $request->id, gravada com sucesso.", ['checklistItemMov'=> $checklistItemMov]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao gravar resposta da pergunta $request->id.". $th->getMessage());
        }
    }

}
