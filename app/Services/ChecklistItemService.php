<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Utils\Functions;
use Carbon\Carbon;
use Exception;

class ChecklistItemService {

    public function initializeChecklistItensMovs(ChecklistMov $checklistMov) {
        $checklistItens = ChecklistItem::with('unitsNoApplicable')
                                        ->where('chkl_id', $checklistMov->chkl_id)
                                       ->whereStatus(Status::ACTIVE)
                                       ->get();

        if(Functions::nullOrEmpty($checklistItens)) 
            throw new Exception("Não existem Perguntas cadastradas para o checklist $checklistMov->chkl_id");

        foreach ($checklistItens as $checklistItem) {
            if(isset($checklistItem->unitsNoApplicable) && $checklistItem->unitsNoApplicable->contains('id',$checklistMov->unit_id)) continue;
            $this->initializeChecklistItemMov($checklistMov, $checklistItem);
        }
    }

    public function initializeChecklistItemMov(ChecklistMov $checklistMov, ChecklistItem $checklistItem) {
        $chim = new ChecklistItemMov();

        $chim->description = $checklistItem->description;
        $chim->sequence = $checklistItem->sequence;
        $chim->score = $checklistItem->score;
        $chim->type = $checklistItem->type;
        $chim->shelflife = $checklistItem->shelflife;
        $chim->required_photo = $checklistItem->required_photo;
        $chim->quant_photo = $checklistItem->quant_photo;
        $chim->sect_id = $checklistItem->sect_id;
        $chim->chit_id = $checklistItem->id;
        $chim->chmv_id = $checklistMov->id;

        $chim->hour_min = Functions::nullOrEmpty($checklistItem->hour_min) ? '00:00': $checklistItem->hour_min;
        $chim->hour_max = Functions::nullOrEmpty($checklistItem->hour_max) ? '23:59': $checklistItem->hour_max;
        $chim->end_date = (Carbon::now())->addHours(5);
        $chim->start_date = Carbon::now();
        
        
        $chim->status = Status::ACTIVE;
        $chim->user_id = null;
        $chim->response = null;

        $chim->save();

        return $chim;        
    }


}