<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebAuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends ControllerWeb {

    public function login() {
        return view('login');
    }

    public function authenticate(WebAuthRequest $request) {
        $user = User::firstWhere('login', $request->login);
        if (!$user || !Hash::check($request->password, $user->password)) {
            Session::flash('flash-error-msg', "As credenciais informadas não são válidas");
            return redirect('/login');
        }

        if($user->access_admin != 'S') {
            Session::flash('flash-error-msg', "Acesso permitido somente a usuários administradores.");
            return Redirect::back();
        }

        Auth::login($user);
        Session::flash('flash-success-msg', "Bem-vindo ao Routine Checklist, $user->name.");
        return redirect('/home');
    }

    public function logout() {
        try {
            Auth::logout();
            Session::flash('flash-success-msg', "Logout executado com sucesso.");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro Ao executar Logout do Usuário");
        }
        return redirect('/login');
    }
}
