<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\Address;
use App\Models\State;
use App\Models\Unity;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UnityController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/unidade/listar','label' => 'Listar Unidades','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/unidade/listar','label' => 'Listar Unidades','active'=>false]];
        $units = Unity::all();
        return view('registrations.unity.list', compact(['breadcrumbs', 'units']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/unidade/salvar';
        $method = 'post';
        return view('registrations.unity.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();

            $address = Address::create($request->address);
            $unityData = $request->unity;
            $unityData['addr_id'] = $address->id;
            Unity::create($unityData);
            Session::flash('flash-success-msg', "Unidade cadastrada com sucesso.");

            DB::commit();
            return redirect('/unidade/novo');
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg = "Erro ao salvar a nova unidade. ".$th->getMessage();
            Log::error($msg, $th);  
            Session::flash('flash-error-msg', $msg);
        }

        return redirect('/unidade/novo')->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/unidade/atualizar/$request->id";
        $method = 'put';
        $unity = Unity::with('address')
                      ->where('id',$request->id)
                      ->first();
        $unity->address->load('city', 'city.state');
        
        if(Functions::nullOrEmpty($unity)){
            Session::flash('flash-error-msg', "Unidade não encontrada na base de dados.");
            return back();
        } 

        return view('registrations.unity.edit', compact('breadcrumbs', 'action', 'method', 'unity'));
    }

    public function update(Request $request){
        try {

            DB::beginTransaction();
            $unity = Unity::firstWhere('id', $request->unity['id']);
            $unity->fill($request->unity);
            $unity->save();

            $address = $unity->address;
            $address->fill($request->address);
            $address->save();

            DB::commit();
            Session::flash('flash-success-msg', "Unidade atualizada com sucesso.");
            return redirect('/unidade/listar');
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg = "Erro ao atualizar a unidade. ".$th->getMessage();
            Log::error($msg, $th);
            Session::flash('flash-error-msg', "Erro ao atualizar a unidade $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

}
