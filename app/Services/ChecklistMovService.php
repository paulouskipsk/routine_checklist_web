<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Utils\Functions;
use Exception;
use Illuminate\Support\Collection;
use stdClass;

class ChecklistMovService {

    public function closeChecklistMov(ChecklistMov $checklistMov, $processAutomatized = false){
        try {
            if($checklistMov->status != Status::ACTIVE->value) throw new Exception("Tarefa $checklistMov->id não está aberta para ser fechada");

            $checklistMov->processed = 'S';
            $checklistMov->processed_in = now();
            $checklistMov->status = $processAutomatized ? Status::CLOSED_BY_SYSTEM : Status::CLOSED;
            $checklistMov->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function reopenChecklistMov(ChecklistMov $checklistMov){
        try {
            if($checklistMov->status != Status::CLOSED_BY_SYSTEM->value && $checklistMov->status != Status::CANCELED->value) throw new Exception("Tarefa $checklistMov->id não está Fechada pelo Sistema ou cancelada para ser reaberta");

            $checklistMov->processed = 'N';
            $checklistMov->processed_in = null;
            $checklistMov->status = Status::ACTIVE;
            $checklistMov->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function cancelChecklistMov(ChecklistMov $checklistMov){
        try {
            if(!($checklistMov->status == Status::CLOSED_BY_SYSTEM->value || $checklistMov->status == Status::ACTIVE->value)) throw new Exception("Tarefa $checklistMov->id não está Fechada pelo Sistema ou ativa para ser cancelada");

            $checklistMov->processed = 'S';
            $checklistMov->processed_in = now();
            $checklistMov->status = Status::CANCELED->value;
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

    private function calculatePercentuals($data){
        $percentQuestionsLost = 0;
        $percentQuestionsExecuted = 0;
        $percentQuestionsNegatives = 0;
        $percentQuestionsAfirmatives = 0;
        $percentQuestionsY = 0;
        $percentQuestionsN = 0;
        $percentQuestionsB = 0;
        $percentQuestionsG = 0;
        $percentQuestionsE = 0;

        if($data['questionsTotals'] > 0){
            $percentQuestionsLost = ($data['questionsLost'] / $data['questionsTotals'])*100;
            $percentQuestionsExecuted = ($data['questionsExecuted'] / $data['questionsTotals'])*100;
            $percentQuestionsNegatives = ($data['questionsNegatives'] / $data['questionsTotals'])*100;
            $percentQuestionsAfirmatives = ($data['questionsAfirmatives'] / $data['questionsTotals'])*100;
            $percentQuestionsY = ($data['questionsY'] / $data['questionsTotals'])*100; 
            $percentQuestionsN = ($data['questionsN'] / $data['questionsTotals'])*100;
            $percentQuestionsB = ($data['questionsB'] / $data['questionsTotals'])*100;
            $percentQuestionsG = ($data['questionsG'] / $data['questionsTotals'])*100;
            $percentQuestionsE = ($data['questionsE'] / $data['questionsTotals'])*100;
        }
        $percentScoreRun = $data['scoreTotal'] > 0 ? ($data['scoreRun'] / $data['scoreTotal'])*100 : 0;
        return [
            'percentScoreRun' => $percentScoreRun,
            'percentQuestionsLost' => $percentQuestionsLost,
            'percentQuestionsExecuted' => $percentQuestionsExecuted,
            'percentQuestionsNegatives' => $percentQuestionsNegatives,
            'percentQuestionsAfirmatives' => $percentQuestionsAfirmatives,
            'percentQuestionsY' => $percentQuestionsY,
            'percentQuestionsN' => $percentQuestionsN,
            'percentQuestionsB' => $percentQuestionsB,
            'percentQuestionsG' => $percentQuestionsG,
            'percentQuestionsE' => $percentQuestionsE,
        ];
    }

    private function calculatePercentualsSectors($dataSectorsEntries){
        $percentagesSectors = [];
        foreach ($dataSectorsEntries as $key => $value) {
            $percentQuestionsLost = 0;
            $percentQuestionsExecuted = 0;
            $percentQuestionsNegatives = 0;
            $percentQuestionsAfirmatives = 0;
            $percentQuestionsY = 0;
            $percentQuestionsN = 0;
            $percentQuestionsB = 0;
            $percentQuestionsG = 0;
            $percentQuestionsE = 0;

            if($value['questionsTotals'] > 0){
                $percentQuestionsLost = ($value['questionsLost'] / $value['questionsTotals'])*100;
                $percentQuestionsExecuted = ($value['questionsExecuted'] / $value['questionsTotals'])*100;
                $percentQuestionsNegatives = ($value['questionsNegatives'] / $value['questionsTotals'])*100;
                $percentQuestionsAfirmatives = ($value['questionsAfirmatives'] / $value['questionsTotals'])*100;
                $percentQuestionsY = ($value['questionsY'] / $value['questionsTotals'])*100; 
                $percentQuestionsN = ($value['questionsN'] / $value['questionsTotals'])*100;
                $percentQuestionsB = ($value['questionsB'] / $value['questionsTotals'])*100;
                $percentQuestionsG = ($value['questionsG'] / $value['questionsTotals'])*100;
                $percentQuestionsE = ($value['questionsE'] / $value['questionsTotals'])*100;
            }
            $percentScoreRun = $value['scoreTotal'] > 0 ? ($value['scoreRun'] / $value['scoreTotal'])*100 : 0;

            $percentagesSectors[$key] = [
                'percentScoreRun' => $percentScoreRun,
                'percentQuestionsLost' => $percentQuestionsLost,
                'percentQuestionsExecuted' => $percentQuestionsExecuted,
                'percentQuestionsNegatives' => $percentQuestionsNegatives,
                'percentQuestionsAfirmatives' => $percentQuestionsAfirmatives,
                'percentQuestionsY' => $percentQuestionsY,
                'percentQuestionsN' => $percentQuestionsN,
                'percentQuestionsB' => $percentQuestionsB,
                'percentQuestionsG' => $percentQuestionsG,
                'percentQuestionsE' => $percentQuestionsE,
            ];
        }
        return $percentagesSectors;
    }

    public function calculateScore(Collection|Array $checklistsMovs){
        try {
            $scoreTotal = 0;
            $scoreRun = 0;
            $questionsLost = 0;
            $questionsExecuted = 0;
            $questionY = 0;
            $questionN = 0;
            $questionG = 0;
            $questionE = 0;
            $questionB = 0;
            $totalQuestionAvaliative = 0;
            $totalQuestionObjetive = 0;
            $data['sectors'] = [];
            $sectors[0] = $this->initializeEntries();
            $fakeSector = new stdClass();

            $fakeSector->id = 0;
            $fakeSector->description = 'Setor Não Informado';
            $data['sectors'][0] = $fakeSector;         
            foreach ($checklistsMovs as $checklistMov) {
                foreach ($checklistMov->checklistItensMovs as $checklistItemMov) {
                    $sectorId = $checklistItemMov->sector?->id ?? 0;
                    $score = $checklistItemMov->score >= 0 ? $checklistItemMov->score : 0;
                    $scoreTotal += $score;

                    if($sectorId > 0){
                        if(!array_key_exists($checklistItemMov->sector->id, $sectors)){
                            $sectors[$sectorId] = $this->initializeEntries();
                            $data['sectors'][$sectorId] = $checklistItemMov->sector;
                        }
                    }
                    $sectors[$sectorId]['scoreTotal'] += $score;

                    if($checklistItemMov->type == 'A'){ 
                        $totalQuestionAvaliative++;
                        $sectors[$sectorId]['totalQuestionAvaliative']++;
                    }else {
                        $totalQuestionObjetive++; 
                        $sectors[$sectorId]['totalQuestionObjetive']++;
                    }                 

                    if($checklistItemMov->processed == 'S'){
                        $questionsExecuted++;
                        $sectors[$sectorId]['questionsExecuted']++;

                        if($checklistItemMov->type == 'S'){
                            if($checklistItemMov->response == 'Y'){
                                $questionY++;
                                $scoreRun += $checklistItemMov->score;
                                $sectors[$sectorId]['questionsY']++;
                                $sectors[$sectorId]['scoreRun'] += $checklistItemMov->score;;
                            }else{
                                $questionN++;
                                $sectors[$sectorId]['questionsN']++;
                            }
                        }else{
                            if($checklistItemMov->response == 'G'){
                                if($checklistItemMov->score > 0){
                                    $questionG++;
                                    $scoreRun += $checklistItemMov->score/2;
                                    $sectors[$sectorId]['questionsG']++;
                                    $sectors[$sectorId]['scoreRun'] += $checklistItemMov->score/2;
                                }
                            }elseif($checklistItemMov->response == 'E'){
                                if($checklistItemMov->score > 0){
                                    $questionE++;
                                    $scoreRun += $checklistItemMov->score;
                                    $sectors[$sectorId]['questionsE']++;
                                    $sectors[$sectorId]['scoreRun'] += $checklistItemMov->score;
                                }
                            }else {
                                $questionB++;
                                $sectors[$sectorId]['questionsB']++;
                            }
                        }
                    }else {
                        $questionsLost++;
                        $sectors[$sectorId]['questionsLost']++;
                    }
                }                 
            }

            $this->proccessSectorEntries($sectors);
            $data['totals'] = [
                'questionsTotals' => $questionsLost + $questionsExecuted,
                'questionsNegatives' => $questionN + $questionB,
                'questionsAfirmatives' => $questionY + $questionG + $questionE,
                'scoreTotal' => $scoreTotal,
                'scoreRun' => $scoreRun,
                'totalQuestionAvaliative' => $totalQuestionAvaliative,
                'totalQuestionObjetive' => $totalQuestionObjetive,
                'questionsExecuted' => $questionsExecuted,
                'questionsLost' => $questionsLost,
                'questionsY' => $questionY,
                'questionsN' => $questionN,
                'questionsG' => $questionG,
                'questionsE' => $questionE,
                'questionsB' => $questionB,
            ];
            $data['totalsSectors'] = $sectors;
            $data['percentages'] = $this->calculatePercentuals($data['totals']);
            $data['percentagesSectors'] = $this->calculatePercentualsSectors($data['totalsSectors']);

            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function initializeEntries(){
        return [
            'scoreTotal' => 0,
            'scoreRun' => 0,
            'questionsLost' => 0,
            'questionsExecuted' => 0,
            'questionsY' => 0,
            'questionsN' => 0,
            'questionsG' => 0,
            'questionsE' => 0,
            'questionsB' => 0,
            'totalQuestionAvaliative' => 0,
            'totalQuestionObjetive' => 0,
            'questionsTotals' => 0,
            'questionsNegatives' => 0,
            'questionsAfirmatives' => 0,
        ];
    }

    private function proccessSectorEntries(Array|Collection &$sectorsEntries){
        foreach ($sectorsEntries as $key => &$value) {
            $value['questionsNegatives'] += $value['questionsN'] + $value['questionsB'];
            $value['questionsAfirmatives'] += $value['questionsY'] + $value['questionsG'] + $value['questionsE'];
            $value['questionsTotals'] = $value['questionsTotals'] + $value['questionsLost'] + $value['questionsExecuted'];
        }
    }
}