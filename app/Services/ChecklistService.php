<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistMov;
use App\Models\Unity;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ChecklistService {

    public function processGenerateTasksChecklists(){
        try {
            $checklistItemService = App::make(ChecklistItemService::class);
            
            $checklists = Checklist::where('status', Status::ACTIVE->value)
                               ->where('chkl_type', 'N')
                               ->get();
            foreach ($checklists as $checklist) {
                if(!$this->shouldRun($checklist)) continue;

                DB::beginTransaction();
                $checklistMov = $this->InitializeChecklistMov($checklist, Unity::find(2));
                $checklistMov->save();

                $checklistItemService->initializeChecklistItensMovs($checklistMov);
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function shouldRun(Checklist $checklist) {
        return true;
    }

    public function InitializeChecklistMov(Checklist $checklist, Unity $unity) {
        $start_date = Carbon::now();
        $end_date = clone($start_date);
        $end_date->addMinutes($checklist->shelflife);

        $checklistMov = new ChecklistMov($checklist->toArray());
        $checklistMov->start_date = $start_date;
        $checklistMov->end_date = $end_date;
        $checklistMov->chkl_id = $checklist->id;
        $checklistMov->unit_id = $unity->id;
        $checklistMov->is_free = 'S';

        return $checklistMov;
    }
}