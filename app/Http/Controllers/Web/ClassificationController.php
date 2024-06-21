<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebClassificationRequest;
use App\Models\ChklClassification;
use App\Utils\Functions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;

class ClassificationController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/classificacao/listar','label' => 'Listar Classificações','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/classificacao/listar','label' => 'Listar Classificações','active'=>false]];
        $classifications = ChklClassification::all();
        return view('registrations.classification.list', compact(['breadcrumbs', 'classifications']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/classificacao/salvar';
        $method = 'post';
        return view('registrations.classification.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(Request $request){
        try {
            if(ChklClassification::where('description', $request->description)->exists()) Session::flash('flash-error-msg', "Classificação lá cadastrada na base de dados.");

            $classification = ChklClassification::create($request->all());
            Session::flash('flash-success-msg', "Classificação cadastrada com sucesso.");
            return redirect('/classificacao/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao salvar o nova Classificação.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/classificacao/atualizar/$request->id";
        $method = 'put';
        $classification = ChklClassification::firstWhere('id',$request->id);

        if(Functions::nullOrEmpty($classification)){
            Session::flash('flash-error-msg', "Classificação não encontrada na base de dados.");
            return back();
        } 

        return view('registrations.classification.edit', compact('breadcrumbs', 'action', 'method', 'classification'));
    }

    public function update(WebClassificationRequest $request){
        try {
            $classification = ChklClassification::firstWhere('id', $request->id);
            $classification->fill($request->all());
            $classification->save();

            Session::flash('flash-success-msg', "Classificação atualizada com sucesso.");
            return redirect('/classificacao/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Classificação $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

    public function delete(Request $request){
        try {
            $chklClassification = ChklClassification::find($request->id);
            $exists = $chklClassification->checklists()->exists() || $chklClassification->checklistsMovs()->exists();
            if($exists)
                Session::flash('flash-error-msg', "Classificação possui Checklists ou Tarefas associadas. Por isso não pode ser excluído.");
            else {
                $chklClassification->delete();
                Session::flash('flash-success-msg', "Classificação '$request->id' Deletada com sucesso.");
            }
        } catch (Exception $th) {
            Session::flash('flash-error-msg', "Erro ao deletar a classificação de checklist '$request->id'. ");
        }
        return redirect('/classificacao/listar');
    }

}
