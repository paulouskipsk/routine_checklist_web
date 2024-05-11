<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\ChecklistMov;
use App\Models\Unity;
use App\Services\ChecklistMovService;
use App\Utils\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends ControllerWeb {

    private $service;

    public function __construct(ChecklistMovService $checklistMovService) {
        $this->service = $checklistMovService;
    }

    public function home(Request $request){
        $reports = [];
        $startDate = Functions::nullOrEmpty($request->start_date) ? Carbon::now()->startOfMonth() :  Carbon::createFromFormat('d/m/Y', $request->start_date);
        $endDate = Functions::nullOrEmpty($request->end_date) ? Carbon::now()->endOfMonth() : Carbon::createFromFormat('d/m/Y', $request->end_date);
        $units = Unity::all();
        $unitsSelecteds = Functions::nullOrEmpty($request->units) ? $units : Unity::find($request->units);
        $unitsSelecteds = $unitsSelecteds->pluck('id');

        $reportFinished = ChecklistMov::where('start_date', '>=', $startDate)
                                      ->where('end_date', '<=', $endDate)
                                      ->where('processed','S')
                                      ->whereIn('unit_id', $unitsSelecteds)
                                      ->get();

        $reports['finishedTotals'] = $this->service->calculateScore($reportFinished);
//==========================================================================================================
        $sql = DB::table('checklists_movs')
                    ->select(DB::raw('count(id) as occurrences'), 'status', 'unit_id')
                    ->where('start_date', '>=', $startDate)
                    ->where('end_date', '<=', $endDate)
                    ->whereIn('unit_id', $unitsSelecteds)
                    ->groupBy('unit_id', 'status')
                    ->get();
        
        $checklistByUnityAndStatus = [];
        foreach ($sql as $value) {
            if(!array_key_exists($value->unit_id, $checklistByUnityAndStatus)){
                $checklistByUnityAndStatus[$value->unit_id] = [
                    Status::ACTIVE->value => 0,
                    Status::CLOSED->value => 0,
                    Status::CLOSED_BY_SYSTEM->value => 0,
                ];
            }

            $status = 'active';
            if($value->status == Status::CLOSED->value) $status = 'completed';
            elseif($value->status == Status::CLOSED_BY_SYSTEM->value) $status = 'incomplete';
            $checklistByUnityAndStatus[$value->unit_id][$status] = $value->occurrences;
        }

        $reports['checklistByUnityAndStatus'] = $checklistByUnityAndStatus;
        return view('home', compact('reports', 'startDate', 'endDate', 'units', 'unitsSelecteds'));
    }



}
