<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Services\ChecklistMovService;
use App\Utils\Functions;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistMovControllerApi extends ControllerApi {

    public function getChecklistsMovByUser(Request $request){
        try {
            $user = Auth::user();
            $unity = $user->unityLogged;
            //Buscar Tarefas livres executáveis
            $freeChecklistsMovsData = ChecklistMov::with('checklist.usersGroups')
                                          ->whereUnitId($unity->id)
                                          ->whereStatus(Status::ACTIVE)
                                          ->whereIs_free("S")
                                          ->whereProcessed('N')
                                          ->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))
                                          ->get();
            //Buscar Tarefas do usuário executáveis
            $userChecklistsMovsData = ChecklistMov::with('checklist.usersGroups')
                                          ->whereUnitId($unity->id)
                                          ->whereStatus(Status::ACTIVE)
                                          ->whereIs_free("N")
                                          ->whereUserId($user->id)
                                          ->whereProcessed('N')
                                          ->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))
                                          ->get();
            
            $freeChecklistsMovs = [];
            foreach ($freeChecklistsMovsData as $checklistMov) {
                if(Functions::inArray($user->usersGroups, $checklistMov->checklist->usersGroups)){
                    $checklistMov->total_questions = ChecklistItemMov::whereChmvId($checklistMov->id)->count();
                    $checklistMov->total_answered = ChecklistItemMov::whereChmvId($checklistMov->id)->whereProcessed('S')->count();
                    $checklistMov->percentage_processed = $checklistMov->total_answered == 0 ? 0 : ($checklistMov->total_answered / $checklistMov->total_questions ) * 100;
                    array_push($freeChecklistsMovs, $checklistMov);
                }
            }

            $userChecklistsMovs = [];
            foreach ($userChecklistsMovsData as $checklistMov) {
                if(Functions::inArray($user->usersGroups, $checklistMov->checklist->usersGroups)){
                    $checklistMov->total_questions = ChecklistItemMov::whereChmvId($checklistMov->id)->count();
                    $checklistMov->total_answered = ChecklistItemMov::whereChmvId($checklistMov->id)->whereProcessed('S')->count();
                    $checklistMov->percentage_processed = $checklistMov->total_answered == 0 ? 0 : ($checklistMov->total_answered / $checklistMov->total_questions ) * 100;
                    array_push($userChecklistsMovs, $checklistMov);
                }
            }

            return $this->responseOk("Tarefas de Checklist Pesquisados com sucesso.", ['freeChecklistsMovs'=> $freeChecklistsMovs, 'userChecklistsMovs'=>$userChecklistsMovs]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao Buscar Tarefas de Checklist. Erro: ". $th->getMessage());
        }
    }

    public function getChecklistMovByIdWithItens(Request $request){
        try {
            $checklistMov = ChecklistMov::findOrFail($request->id);
            $checklistMov->checklist_itens_movs = ChecklistItemMov::where('chmv_id', $checklistMov->id)
                                                                    ->where('processed', 'N')
                                                                    ->where('status', 'A')
                                                                    ->with('sector')
                                                                    ->get();

            return $this->responseOk("Tarefa de Checklist Pesquisado com sucesso.", ['checklistMov'=> $checklistMov]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao Buscar Tarefa de Checklist". $th->getMessage());
        }
    }

    public function associateChecklistMov(Request $request){
        try {           
            $checklistMov = ChecklistMov::find($request->checklistMovId);
            if(!$checklistMov) throw new Exception("ChecklistMov não encontrado com o código '$request->checklistMovId'");
            $user = Auth::user();
            $checklistMov->user_id = $user->id;
            $checklistMov->is_free = 'N';
            $checklistMov->save();
            return $this->responseOk("Checklist Associado ao usuário '$user->name'  com sucesso.", ['checklistMov'=>$checklistMov]);
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function disassociateChecklistMov(Request $request){
        try {           
            $checklistMov = ChecklistMov::find($request->checklistMovId);
            if(!$checklistMov) throw new Exception("ChecklistMov não encontrado com o código '$request->checklistMovId'");
            $checklistMov->user_id = null;
            $checklistMov->is_free = 'S';
            $checklistMov->save();
            return $this->responseOk("Checklist liberado com sucesso.", ['checklistMov'=>$checklistMov->refresh()]);
        } catch (\Throwable $th) {
            return $this->responseError($th->getMessage());
        }
    }

    public function finishChecklist(Request $request) {
        try {
            $checklistMov = ChecklistMov::find($request->checklist_id);
            $this->checklistIsValidForFinish($checklistMov);
            $checklistMovService = new ChecklistMovService();
            $checklistMovService->closeChecklistMov($checklistMov);
            return $this->responseOk("Checklist Finalizado com sucesso.");
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao finalizar checklist. Erro : " . $th->getMessage());
        }
    }

    private function checklistIsValidForFinish(ChecklistMov $checklistMov) {
        if(Functions::nullOrEmpty($checklistMov)) throw new Exception("Checklist não encontrado com o código informado.");
        if($checklistMov->status <> Status::ACTIVE){
            if($checklistMov->status == Status::CLOSED) 
                throw new Exception("Checklist com código '$checklistMov->id' já está finalizado.");
            elseif($checklistMov->status == Status::CLOSED_BY_SYSTEM) 
                throw new Exception("Checklist com código '$checklistMov->id' já está expirado, e foi finalizado pelo sistema.");
        }
    }

}