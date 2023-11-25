<?php

namespace App\Http\Controllers\Api;

use App\Enums\Status;
use App\Models\Checklist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ChecklistControllerApi extends ControllerApi {

    public function getChecklistsByUser(Request $request){
        $checklists = Checklist::whereStatus(Status::ACTIVE)
                               ->get();
            return $this->responseOk("ok", ['checklists' => $checklists]);
    }


}
