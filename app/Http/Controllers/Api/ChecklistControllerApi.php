<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ChecklistControllerApi extends ControllerApi {

    public function getChecklistsByUser(Request $request){
        $user = Auth::user();
        $checklists = Checklist::whereStatus(Status::ACTIVE)
                               ->where()
    }


}
