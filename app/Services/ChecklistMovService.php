<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use Illuminate\Support\Collection;

class ChecklistMovService {

    public function closeChecklistMov(ChecklistMov $checklistMov, $processAutomatized = false){
        try {
            $checklistMov->processed = 'S';
            $checklistMov->status = $processAutomatized ? Status::CLOSED_BY_SYSTEM : Status::CLOSED;
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

    public function calculateScore(Collection|Array $checklistsMovs){
        try {
            $scoreTotal = 0;
            $scoreRun = 0;
            $totalQuestions = 0;
            $questionsLost = 0;
            $questionsExecuted = 0;
            $questionsNegatives = 0;
            $questionsPositives = 0;

            foreach ($checklistsMovs as $checklistMov) {
                $questionsLostThis = 0;
                $questionsExecutedThis = 0;
                $questionsNegativesThis = 0;
                $questionsPositivesThis = 0;
                $scoreRunThis = 0;
                foreach ($checklistMov->checklistItensMovs as $checklistItenMov) {
                    $scoreTotal += $checklistItenMov->score >= 0 ? $checklistItenMov->score : 0;
                    $totalQuestions ++;

                    if($checklistItenMov->processed == 'N'){
                        $questionsLostThis ++;
                    }else {
                        $questionsExecutedThis ++;

                        if($checklistItenMov->type == 'S'){
                            if($checklistItenMov->response == 'Y'){
                                $scoreRunThis += $checklistItenMov->score;
                                $questionsPositivesThis ++;
                            }else{
                                $questionsNegativesThis ++;
                            }
                        }else{
                            if($checklistItenMov->response == 'G' || $checklistItenMov->response == 'E'){
                                $questionsPositivesThis ++;

                                if($checklistItenMov->score > 0)
                                    $scoreRunThis += $checklistItenMov->response == 'E' ? $checklistItenMov->score : $checklistItenMov->score/2 ;
                                            
                            }else $questionsNegativesThis ++;
                        }
                    }
                } 
                
                $questionsLost += $questionsLostThis;
                $questionsExecuted += $questionsExecutedThis;
                $questionsNegatives += $questionsNegativesThis;
                $questionsPositives += $questionsPositivesThis;
                $scoreRun += $scoreRunThis;
            }

            $data['totals'] = [
                'scoreTotal' => $scoreTotal,
                'scoreRun' => $scoreRun,
                'questionsTotals' => $totalQuestions,
                'questionsLost' => $questionsLost,
                'questionsExecuted' => $questionsExecuted,
                'questionsNegatives' => $questionsNegatives,
                'questionsAfirmatives' => $questionsPositives,
            ];

            $data['percentages'] = $this->calculatePercentuals($data['totals']);
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function calculatePercentuals($data){
        $percentScoreRun = $data['scoreTotal'] > 0 ? ($data['scoreRun'] / $data['scoreTotal'])*100 : 0;
        $percentQuestionsLost = $data['questionsTotals'] > 0 ? ($data['questionsLost'] / $data['questionsTotals'])*100 : 0;;
        $percentQuestionsExecuted = $data['questionsTotals'] > 0 ? ($data['questionsExecuted'] / $data['questionsTotals'])*100 : 0;
        $percentQuestionsNegatives = $data['questionsTotals'] > 0 ? ($data['questionsNegatives'] / $data['questionsTotals'])*100 : 0;
        $percentQuestionsAfirmatives = $data['questionsTotals'] > 0 ? ($data['questionsAfirmatives'] / $data['questionsTotals'])*100 : 0;

        return [
            'percentScoreRun' => $percentScoreRun,
            'percentQuestionsLost' => $percentQuestionsLost,
            'percentQuestionsExecuted' => $percentQuestionsExecuted,
            'percentQuestionsNegatives' => $percentQuestionsNegatives,
            'percentQuestionsAfirmatives' => $percentQuestionsAfirmatives
        ];
    }
}