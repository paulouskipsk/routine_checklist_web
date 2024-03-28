<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Models\User;
use App\Utils\Functions;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ChecklistItemMovService {

    public function answerQuestion(Request $request, User $user){
        $errors = new Collection();

        if(empty($request->id)) throw new exception("Codigo da Pergunta não informado.");

        $checklistItemMov = ChecklistItemMov::find($request->id);
        $checklistItemMov->load('checklistItem');

        if($checklistItemMov->type_obs == 'R' && empty($request->observation)) $errors[] = "Campo 'observation' não informado.";
        if(empty($request->response)) $errors[] = "Campo 'response' não informado.";
        if($checklistItemMov->required_photo == 'S' && empty($request->photos)) $errors[] = "Campo 'photos' não informado.";
        if($checklistItemMov->required_photo == 'S' && sizeof($request->photos) < $checklistItemMov->quant_photo) $errors[] = "Quantidade de 'photos' Menor que o exigido na pergunta.";

        if($errors->isNotEmpty()) throw new Exception($errors);

        
        $checklistItemMov->observation = $request->observation;
        $checklistItemMov->response = $request->response;
        $checklistItemMov->photos = $request->photos;
        $checklistItemMov->user_id = $user->id;
        $checklistItemMov->processed = 'S';
        $checklistItemMov->save();

        return $checklistItemMov;
    }


}