<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use Illuminate\Support\Collection;

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

    public function generateChecklistMov(Checklist $checklist, Collection $units){
        try {
            $checklistService = new ChecklistService();
            $checklistItemService = new ChecklistItemService();
            foreach ($units as $unity) {
                if($checklist->units->contains($unity)){
                    $checklistMov = $checklistService->InitializeChecklistMov($checklist, $unity);
                    $checklistMov->save();
                    $checklistItemService->initializeChecklistItensMovs($checklistMov);
                }
            }            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}