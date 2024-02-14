<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Utils\Functions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistMovControllerApi extends ControllerApi {

    public function getChecklistsMovByUser(Request $request){
        try {
            $user = Auth::user();
            $checklistsMovs = ChecklistMov::with('checklist.usersGroups')
                                         // ->whereUnitId($request->unity_id)
                                          ->whereStatus(Status::ACTIVE)
                                          ->where('end_date', '>', Carbon::now()->format('Y-m-d H:i:s'))
                                          ->get();
            
            $response = [];
            foreach ($checklistsMovs as $checklistMov) {
                if(Functions::inArray($user->usersGroups, $checklistMov->checklist->usersGroups)){
                    $checklistMov->total_questions = ChecklistItemMov::whereChmvId($checklistMov->id)->count();
                    $checklistMov->total_answered = ChecklistItemMov::whereChmvId($checklistMov->id)->whereProcessed('S')->count();
                    $checklistMov->percentage_processed = $checklistMov->total_answered == 0 ? 0 : ($checklistMov->total_answered / $checklistMov->total_questions ) * 100;
                    array_push($response, $checklistMov);
                }
            }

            return $this->responseOk("Tarefas de Checklist Pesquisados com sucesso.", ['checklistsMovs'=> $response]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao Buscar Tarefas de Checklist". $th->getMessage());
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

}
