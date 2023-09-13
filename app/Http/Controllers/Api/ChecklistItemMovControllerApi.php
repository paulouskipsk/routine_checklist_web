<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\ChecklistItemMov;
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

}
