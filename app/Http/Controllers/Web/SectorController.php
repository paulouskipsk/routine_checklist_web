<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebSectorRequest;
use App\Models\Sector;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SectorController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/setor/listar','label' => 'Listar Setores','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/setor/listar','label' => 'Listar Setores','active'=>false]];
        $sectors = Sector::all();
        return view('registrations.sector.list', compact(['breadcrumbs', 'sectors']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/setor/salvar';
        $method = 'post';
        return view('registrations.sector.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(WebSectorRequest $request){
        try {
            $sector = Sector::create($request->all());
            Session::flash('flash-success-msg', "Setor cadastrado com sucesso.");
            return redirect('/setor/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao salvar o novo Setor.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/setor/atualizar/$request->id";
        $method = 'put';
        $sector = Sector::firstWhere('id',$request->id);

        if(Functions::nullOrEmpty($sector)){
            Session::flash('flash-error-msg', "Setor não encontrado na base de dados.");
            return back();
        } 

        return view('registrations.sector.edit', compact('breadcrumbs', 'action', 'method', 'sector'));
    }

    public function update(WebSectorRequest $request){
        try {
            $sector = Sector::firstWhere('id', $request->id);
            $sector->fill($request->all());
            $sector->save();

            Session::flash('flash-success-msg', "Setor atualizado com sucesso.");
            return redirect('/setor/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Setor $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

}
