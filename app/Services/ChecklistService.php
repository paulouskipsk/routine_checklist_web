<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistMov;
use App\Models\Unity;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChecklistService {

    public function processGenerateTasksChecklists(){
        try {
            $checklistItemService = App::make(ChecklistItemService::class);
            $units = Unity::whereStatus(Status::ACTIVE)->get();

            DB::beginTransaction();
            foreach ($units as $unity) {
                $checklists = Checklist::whereHas('units', function ($query) use ($unity) {
                    $query->where('unit_id', $unity->id);
                })->whereStatus(Status::ACTIVE)->get();

                foreach ($checklists as $checklist) {
                    if(!$this->shouldRun($checklist, $unity)) continue;

                    try {
                        DB::beginTransaction();

                        $checklistMov = $this->InitializeChecklistMov($checklist, $unity);
                        $checklistMov->save();    
                        $checklistItemService->initializeChecklistItensMovs($checklistMov);

                        DB::commit();
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        Log::error($th);
                        continue;
                    }                    
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function shouldRun(Checklist $checklist, Unity $unity) {
        if($checklist->status != Status::ACTIVE || $unity->status != Status::ACTIVE) return false;
        return true;
    }

    public function InitializeChecklistMov(Checklist $checklist, Unity $unity) {
        $start_date = Carbon::now();
        $end_date = clone($start_date);
        $end_date->addMinutes($checklist->shelflife);

        $checklistMov = new ChecklistMov();

        $checklistMov->description = $checklist->description; 
        $checklistMov->generate_time = $checklist->generate_time; 
        $checklistMov->shelflife = $checklist->shelflife; 
        $checklistMov->frequency = $checklist->frequency; 
        $checklistMov->frequency_composition = $checklist->frequency_composition; 
        $checklistMov->status = $checklist->status; 
        // $checklistMov->chkl_type = $checklist->chkl_type; 
        // $checklistMov->changed_by_user = $checklist->changed_by_user; 
        $checklistMov->chcl_id = $checklist->chcl_id; 

        $checklistMov->start_date = $start_date;
        $checklistMov->end_date = $end_date;
        $checklistMov->chkl_id = $checklist->id;
        $checklistMov->unit_id = $unity->id;
        $checklistMov->is_free = 'S';

        return $checklistMov;
    }
}