<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebClassificationRequest;
use App\Models\ChklClassification;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

    public function store(WebClassificationRequest $request){
        try {
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
        $method = 'post';
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

}
