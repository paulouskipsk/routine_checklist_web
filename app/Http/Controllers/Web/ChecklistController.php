<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebChecklistRequest;
use App\Models\Checklist;
use App\Models\ChklClassification;
use App\Utils\Functions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ChecklistController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/checklist/listar','label' => 'Listar Checklistes','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/checklist/listar','label' => 'Listar Checklistes','active'=>false]];
        $checklists = Checklist::all();
        return view('registrations.checklist.list', compact(['breadcrumbs', 'checklists']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/checklist/salvar';
        $method = 'post';
        $classifications = ChklClassification::whereStatus('A')->get();
        return view('registrations.checklist.new', compact('breadcrumbs', 'action', 'method', 'classifications'));
    }

    public function store(Request $request){
        try {
            $data = $request->all();
            $data['changed_by_user'] = Auth::user()->id;
            Checklist::create($data);
            Session::flash('flash-success-msg', "Checklist cadastrado com sucesso.");
            return redirect('/checklist/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao salvar o novo Checklist.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/checklist/atualizar/$request->id";
        $method = 'post';
        $checklist = Checklist::firstWhere('id',$request->id);

        if(Functions::nullOrEmpty($checklist)){
            Session::flash('flash-error-msg', "Checklist não encontrado na base de dados.");
            return back();
        } 

        return view('registrations.checklist.edit', compact('breadcrumbs', 'action', 'method', 'checklist'));
    }

    public function update(WebChecklistRequest $request){
        try {
            $checklist = Checklist::firstWhere('id', $request->id);
            $checklist->fill($request->all());
            $checklist->save();

            Session::flash('flash-success-msg', "Checklist atualizado com sucesso.");
            return redirect('/checklist/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Checklist $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

}
