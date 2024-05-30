<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\ChecklistItemMov;
use App\Models\ChecklistMov;
use App\Models\Unity;
use App\Models\Views\ViewChecklistItensMovsPerformeds;
use App\Services\ChecklistMovService;
use App\Utils\Functions;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ManageController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/gerenciar/tarefas','label' => 'Gerenciar Tarefas','active'=>true]];
    private $checklistMovServ;

    public function __construct(ChecklistMovService $checklistMovService) {
        $this->checklistMovServ = $checklistMovService;
    }

    public function index(Request $request){
        $breadcrumbs = [['url'=> '/gerenciar/tarefas','label' => 'Gerenciar Tarefas','active'=>false]];

        $startDate = Functions::nullOrEmpty($request->start_date) ? Carbon::now()->startOfMonth() :  Carbon::createFromFormat('d/m/Y', $request->start_date);
        $endDate = Functions::nullOrEmpty($request->end_date) ? Carbon::now()->endOfMonth() : Carbon::createFromFormat('d/m/Y', $request->end_date);
        $units = Unity::all();
        $unitsSelecteds = Functions::nullOrEmpty($request->units) ? $units : Unity::find($request->units);
        $unitsSelecteds = $unitsSelecteds->pluck('id');

        $checklists = ChecklistMov::where('start_date', '>=', $startDate)
                                      ->where('end_date', '<=', $endDate)
                                    //   ->where('processed','S')
                                      ->whereIn('unit_id', $unitsSelecteds)
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
            $checklistMovService = new ChecklistMovService();//App::make(ChecklistMovService::class);
            $checklistMov = ChecklistMov::find($request->id);
            if(Functions::nullOrEmpty($checklistMov))  throw new Exception("Tarefa $request->id não encontrada");
            $checklistMov->load('checklistItensMovs');
            $report = $checklistMovService->calculateScore([$checklistMov]);
            return view('reports_views.view-movement', compact(['checklistMov', 'report']));
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', " Erro ao Abrir relatório da Tarefa '$request->id'. " . $th->getMessage());
            return back();
        }
    }

    // public function getPdf(Request $request){
    //     try {
    //         $checklistMovService = new ChecklistMovService();
    //         $checklistMov = ChecklistMov::find($request->id);
    //         if(Functions::nullOrEmpty($checklistMov))  throw new Exception("Tarefa $request->id não encontrada");
    //         $checklistMov->load('checklistItensMovs');
    //         $report = $checklistMovService->calculateScore([$checklistMov]);

    //         $pdf = Pdf::loadView('reports.declaracao-rcm', compact('titleReport','unidade', 'usuario', 'config','fornecedor', 'tarefa', 'notasProdutos'));
    //         $filePath = "$this->tmp/file_tmp_".Functions::getTimeInMillis().'.pdf';
    //         Storage::put($filePath, $pdf->download()->getOriginalContent());
    //         $report = Storage::path($filePath);           

    //         return back();
    //     } catch (\Throwable $th) {
    //         Session::flash('flash-error-msg', " Erro ao Gerar o relatório da Tarefa '$request->id'. " . $th->getMessage());
    //         return back();
    //     }
    // }

}