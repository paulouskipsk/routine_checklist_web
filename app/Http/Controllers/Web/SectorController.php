<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebSectorStoreRequest;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SectorController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '','label' => 'Setor','active'=>false]];

    public function index(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>true];
        $breadcrumbs = $this->breadcrumbs;
        $sectors = Sector::all();
        return view('sector.list', compact(['breadcrumbs', 'sectors']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>true];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/setor/salvar';
        $method = 'post';
        return view('sector.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(WebSectorStoreRequest $request){
        try {
            $sector = Sector::create($request->all());
            Session::flash('flash-success-msg', "Setor cadastrado com sucesso.");
            return redirect('/setor/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao salvar o novo Setor.");
        }

        return Redirect::back()->with($request->all());
    }

}
