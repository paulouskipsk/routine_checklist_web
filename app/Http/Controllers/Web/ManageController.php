<?php

namespace App\Http\Controllers\Web;

use App\Models\ChecklistMov;
use App\Models\Unity;
use App\Services\ChecklistMovService;
use App\Utils\Functions;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ManageController extends ControllerWeb {
    private $checklistMovServ;

    public function __construct(ChecklistMovService $checklistMovService) {
        $this->checklistMovServ = $checklistMovService;
    }

    public function index(Request $request){
        $breadcrumbs = [['url'=> '/gerenciar/tarefas','label' => 'Gerenciar Tarefas','active'=>false]];

        $startDate = Functions::nullOrEmpty($request->start_date) ? Carbon::now()->startOfMonth() :  Carbon::createFromFormat('d/m/Y', $request->start_date);
        $startDate->setHour(0)->setMinute(0)->setSecond(0);
        $endDate = Functions::nullOrEmpty($request->end_date) ? Carbon::now()->endOfMonth() : Carbon::createFromFormat('d/m/Y', $request->end_date);
        $endDate->setHour(23)->setMinute(59)->setSecond(59);
        $units = Unity::all();
        $unitsSelecteds = Functions::nullOrEmpty($request->units) ? $units : Unity::find(explode(',', $request->units));
        $unitsSelecteds = $unitsSelecteds->pluck('id');

        $checklists = ChecklistMov::where('start_date', '>=', $startDate)
                                  ->where('end_date', '<=', $endDate)
                                  ->whereIn('unit_id', $unitsSelecteds)
                                  ->limit(500)
                                  ->get();
        
        return view('manage.tasks.list', compact(['breadcrumbs', 'checklists', 'startDate', 'endDate', 'units', 'unitsSelecteds']));
    }

    public function reopen(Request $request){
        try {
            $task = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($task))  throw new Exception("Tarefa $request->id não encontrada");
            $this->checklistMovServ->reopenChecklistMov($task);
            Session::flash('flash-success-msg', "Tarefa '$request->id' reaberta com sucesso!");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao reabrir a Tarefa '$request->id'. " . $th->getMessage());
        }
        return back();
    }

    public function close(Request $request){
        try {
            $task = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($task))  throw new Exception("Tarefa $request->id não encontrada");
            $this->checklistMovServ->closeChecklistMov($task);
            Session::flash('flash-success-msg', "Tarefa '$request->id' fechada com sucesso!");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao fechar a Tarefa '$request->id'. " . $th->getMessage());
        }
        return back();
    }

    public function cancel(Request $request){
        try {
            $task = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($task))  throw new Exception("Tarefa $request->id não encontrada");
            $this->checklistMovServ->cancelChecklistMov($task);
            Session::flash('flash-success-msg', "Tarefa '$request->id' cancelada com sucesso!");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao cancelar a Tarefa '$request->id'. " . $th->getMessage());
        }
        return back();
    }

    public function view(Request $request){
        try {
            $checklistMovService = new ChecklistMovService();
            $checklistMov = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($checklistMov))  throw new Exception("Tarefa $request->id não encontrada");
            $checklistMov->load('checklistItensMovs');
            $report = $checklistMovService->calculateScore([$checklistMov]);
            return view('reports-views.view-movement', compact(['checklistMov', 'report']));
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao Abrir relatório da Tarefa '$request->id'. " . $th->getMessage());
            return back();
        }
    }

    public function getPdf(Request $request){
        try {
            $checklistMov = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($checklistMov))  throw new Exception("Tarefa $request->id não encontrada");

            $titleFile = "Relatório de Movimento Tarefa $checklistMov->id";
            $titleReport = "Relatório de Movimento de Checklist";
            $unity = $checklistMov->unity;
            $user = Auth::user();
            $checklistMovService = new ChecklistMovService();

            $checklistMov->load('checklistItensMovs');
            $report = $checklistMovService->calculateScore([$checklistMov]);

            $pdf = Pdf::loadView('reports-pdf.view-movement', compact('titleReport', 'unity', 'user', 'checklistMov', 'report'));
            return $pdf->stream();
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao Gerar o relatório da Tarefa '$request->id'. " . $th->getMessage());
            return back();
        }
    }

    public function appDownload(){
        $routineChecklistApk = public_path('downloads/routine_checklist.apk');
        return Response::download($routineChecklistApk, 'routine_checklist.apk', []);
    }
}