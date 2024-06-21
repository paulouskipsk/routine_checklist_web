<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Http\Requests\WebChecklistRequest;
use App\Models\Checklist;
use App\Models\ChklClassification;
use App\Models\Unity;
use App\Models\UsersGroup;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Services\ChecklistMovService;
use App\Traits\Api\ResponseCreator;
use Exception;
use Illuminate\Support\Facades\DB;

class ChecklistController extends ControllerWeb {
    use ResponseCreator;
    private $breadcrumbs = [['url'=> '/checklist/listar','label' => 'Listar Checklists','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/checklist/listar','label' => 'Listar Checklists','active'=>false]];
        $checklists = Checklist::all();
        $units = [];
        foreach (Unity::whereStatus(Status::ACTIVE)->get() as $unity) {
            $units[$unity->id] = $unity;
        }
        $units = collect($units);
        Unity::whereStatus(Status::ACTIVE)->get();
        return view('registrations.checklist.list', compact(['breadcrumbs', 'checklists', 'units']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/checklist/salvar';
        $method = 'post';
        $classifications = ChklClassification::whereStatus(Status::ACTIVE)->get();
        $units = Unity::whereStatus(Status::ACTIVE)->get();
        $usersGroups = UsersGroup::whereStatus(Status::ACTIVE)->get();

        return view('registrations.checklist.new', compact('breadcrumbs', 'action', 'method', 'classifications', 'units', 'usersGroups'));
    }

    public function store(WebChecklistRequest $request){
        try {
            $data = $request->all();
            $data['changed_by_user'] = Auth::user()->id;
            $checklist = Checklist::create($data);
            $checklist->units()->sync($request->units);
            $checklist->usersGroups()->sync($request->usersGroups);

            Session::flash('flash-success-msg', "Checklist cadastrado com sucesso.");
            return redirect("/checklist-item/novo/checklist/$checklist->id");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao salvar o novo Checklist.");
        }
        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/checklist/atualizar/$request->id";
        $method = 'put';
        $checklist = Checklist::with('units', 'usersGroups')->firstWhere('id',$request->id);
        $classifications = ChklClassification::whereStatus(Status::ACTIVE)->get();
        $units = Unity::whereStatus(Status::ACTIVE)->get();
        $usersGroups = UsersGroup::whereStatus(Status::ACTIVE)->get();

        if(Functions::nullOrEmpty($checklist)){
            Session::flash('flash-error-msg', "Checklist não encontrado na base de dados.");
            return back();
        } 
        return view('registrations.checklist.edit', compact('breadcrumbs', 'action', 'method', 'checklist', 'classifications', 'units', 'usersGroups'));
    }

    public function update(WebChecklistRequest $request){
        try {            
            $checklist = Checklist::firstWhere('id', $request->id);
            $checklist->fill($request->all());
            $checklist->changed_by_user = Auth::user()->id;
            $checklist->save();
            $checklist->units()->sync($request->units);
            $checklist->usersGroups()->sync($request->usersGroups);

            Session::flash('flash-success-msg', "Checklist atualizado com sucesso.");
            return redirect('/checklist/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Checklist $request->id.");
        }
        return Redirect::back()->with($request->all());
    }

    public function delete(Request $request){
        try {
            $checklist = Checklist::firstWhere('id', $request->id);
            $checklistItens = $checklist->checklistItens;

            $checklistItens->each(function($checklistItem) {
                $checklistItem->checklistItensMovs()->exists() ? $checklistItem->delete() : $checklistItem->forceDelete();
            });
            $checklist->checklistsMovs()->exists() ? $checklist->delete() : $checklist->forceDelete();
            
            Session::flash('flash-success-msg', "Checklist deletado com sucesso.");
                return redirect('/checklist/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao deletado o Checklist $request->id. ".$th->getMessage());
        }
        return Redirect::back()->with($request->all());
    }

    public function generateTasks(Request $request){
        try {
            DB::beginTransaction();
            $units = Unity::find($request->units);
            $checklist = Checklist::find($request->checklistId);

            $serv = new ChecklistMovService();
            if(!$checklist) throw new Exception("Checklist '$request->chkl_id' Não encontrado");
            $serv->generateChecklistMov($checklist, $units);
            DB::commit();

            return $this->responseOk("Tarefas para o checklist $checklist->id, geradas com sucesso.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseError("Não foi possível gerar as tarefas para o checklist $request->chkl_id.". $th->getMessage());
        }      
    }

}
