<?php

namespace App\Services;

use App\Enums\Frequency;
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
        if($checklist->status != Status::ACTIVE->value || $unity->status != Status::ACTIVE->value) return false;

        $now = Carbon::now()->setSeconds(0)->setMicroseconds(0);
        $hourSinc = Carbon::parse($checklist->generate_time);

        if(!$now->equalTo($hourSinc)) return false;
        return match ($checklist->frequency) {
            Frequency::DAILY->value => true,
            Frequency::FORTNIGHTLY->value => $now->day == 1 || $now->day == 15,
            Frequency::WEEKLY->value => in_array($now->dayOfWeek, $checklist->frequency_composition),
            Frequency::MONTHLY->value => in_array($now->day, $checklist->frequency_composition),
            default => false
        };
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
        $checklistMov->processed = 'N';

        return $checklistMov;
    }
}