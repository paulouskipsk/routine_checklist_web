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
use Illuminate\Http\Request;

class ChecklistItemMovService {

    public function answerQuestion(Request $request, User $user){
        // $errors = new Collection();
            // if(empty($request->observation)) $errors[] = "Campo 'observation' não informado.";
            // if(empty($request->response)) $errors[] = "Campo 'response' não informado.";
            // if(empty($request->photos)) $errors[] = "Campo 'photos' não informado.";
            // if(empty($request->id)) $errors[] = "Campo 'id' não informado.";

            // if(!empty($errors)) throw new Exception($errors);

            $checklistItemMov = ChecklistItemMov::find($request->id);
            $checklistItemMov->observation = $request->observation;
            $checklistItemMov->response = $request->response;
            $checklistItemMov->photos = $request->photos;
            $checklistItemMov->user_id = $user->id;
            $checklistItemMov->processed = 'S';
            $checklistItemMov->save();

           

            $checklistItemMov->load('sector');
            return $checklistItemMov;
    }


}