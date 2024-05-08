<?php

namespace App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\User;
use App\Utils\Functions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends ControllerWeb {

    private $breadcrumbs = [['url'=> '/usuario/listar','label' => 'Listar Usuários','active'=>true]];

    public function index(){
        $breadcrumbs = $breadcrumbs = [['url'=> '/usuario/listar','label' => 'Listar Usuários','active'=>false]];
        $users = User::all();
        return view('registrations.user.list', compact(['breadcrumbs', 'users']));
    }

    public function create(){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Novo','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = '/usuario/salvar';
        $method = 'post';
        return view('registrations.user.new', compact('breadcrumbs', 'action', 'method'));
    }

    public function store(Request $request){
        $all = $request->all();
        try {
            $user = User::create($request->all());
            Session::flash('flash-success-msg', "Usuário cadastrado com sucesso.");
            return redirect('/usuario/novo');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao salvar o novo usuário.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $this->breadcrumbs[] = ['url'=> '', 'label' => 'Editar','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/usuario/atualizar/$request->id";
        $method = 'put';
        $user = User::firstWhere('id',$request->id);

        if(Functions::nullOrEmpty($user)){
            Session::flash('flash-error-msg', "Usuário não encontrado na base de dados.");
            return back();
        } 

        return view('registrations.user.edit', compact('breadcrumbs', 'action', 'method', 'user'));
    }

    public function update(Request $request){
        try {
            $user = User::firstWhere('id', $request->id);
            $user->fill($request->all());
            $user->save();

            Session::flash('flash-success-msg', "Usuário atualizado com sucesso.");
            return redirect('/usuario/listar');
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Usuário $request->id.");
        }

        return Redirect::back()->with($request->all());
    }
    public function delete(Request $request){
    }










    public function getUsersByName(Request $request) {
        $users = User::where('name', 'ilike', "%$request->name%")->whereStatus(Status::ACTIVE)->get();
        if(Functions::nullOrEmpty($users)) return [];

        return $users;
    }
}