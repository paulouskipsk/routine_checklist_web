<?php

namespace App\Http\Controllers\Web;

use App\Models\UserGroup;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserGroupController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/grupo-usuarios/listar','label' => 'Listar Gr. Usuários','active'=>true]];

    public function index(){
        $breadcrumbs = [['url'=> '/grupo-usuarios/listar','label' => 'Listar Grupos de Usuários','active'=>false]];
        $userGroups = UserGroup::all();
        return view('registrations.user-group.list', compact(['breadcrumbs', 'userGroups']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/grupo-usuarios/salvar';
        $method = 'post';
        return view('registrations.user-group.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(Request $request){
        try {
            $data = $request->all();
            $usersId = explode(',', $request->users_selecteds);
            unset($data['users_selecteds']);
            $userGroup = UserGroup::create($data);
            if(!empty($usersId)) $userGroup->users()->sync($usersId);

            Session::flash('flash-success-msg', "Grupo de Usuários cadastrado com sucesso.");
            return redirect('/grupo-usuarios/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao salvar o novo Grupo de Usuários.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/grupo-usuarios/atualizar/$request->id";
        $method = 'put';
        $userGroup = UserGroup::firstWhere('id',$request->id);

        if(Functions::nullOrEmpty($userGroup)){
            Session::flash('flash-error-msg', "Grupo de Usuários não encontrado na base de dados.");
            return back();
        } 

        return view('registrations.user-group.edit', compact('breadcrumbs', 'action', 'method', 'userGroup'));
    }

    public function update(Request $request){
        try {
            $userGroup = UserGroup::firstWhere('id', $request->id);
            $data = $request->all();
            $usersId = explode(',', $request->users_selecteds);
            unset($data['users_selecteds']);
            $userGroup->fill($data);
            $userGroup->save();
            if(!empty($usersId)) $userGroup->users()->sync($usersId);

            Session::flash('flash-success-msg', "Grupo de Usuários atualizado com sucesso.");
            return redirect('/grupo-usuarios/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Grupo de Usuários $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

    public function delete(Request $request){
    }
}
