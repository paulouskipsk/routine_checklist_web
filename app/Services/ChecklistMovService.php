<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;

class ChecklistMovService {

    public function closeChecklistMov(ChecklistMov $checklistMov){
        try {
            $checklistMov->processed = 'S';
            $checklistMov->status = Status::CLOSED;
            $checklistMov->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}