<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
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

            // $errors = new Collection();
            // if(empty($request->observation)) $errors[] = "Campo 'observation' não informado.";
            // if(empty($request->response)) $errors[] = "Campo 'response' não informado.";
            // if(empty($request->photos)) $errors[] = "Campo 'photos' não informado.";
            // if(empty($request->id)) $errors[] = "Campo 'id' não informado.";

            // if(!empty($errors)) throw new Exception($errors);

            $checklistItemMov = checklistItemMov::find($request->id);
            $checklistItemMov->observation = $request->observation;
            $checklistItemMov->response = $request->response;
            $checklistItemMov->photos = $request->photos;
            $checklistItemMov->user_id = Auth::user()->id;
            $checklistItemMov->save();

            $checklistItemMov->load('sector');

            return $this->responseOk("Resposta $request->id, gravada com sucesso.", ['checklistItemMov'=> $checklistItemMov]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao gravar resposta da pergunta $request->id.", json_decode($th->getMessage()));
        }
    }

}
