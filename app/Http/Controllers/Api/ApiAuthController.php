<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ControllerApi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends ControllerApi
{
    public function authenticate(Request $request) {
        try {
            if(!Auth::attempt($request->only(['login', 'password'])))
                return $this->response(false, 401, "Login ou senha não conferem");
            
            $user = User::where('login', $request->login)->first();
            return $this->responseOk("Seja bem vindo, $user->name.", ['token'=>$user->createToken("API TOKEN")->plainTextToken]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao efetuar login: "+ $th->getMessage());
        }
    }

    public function user(){
        try {
            $user = Auth::user();
            return $this->responseOk("Usuário autenticado recuperado com sucesso.", ['user' => $user]);
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao recuperar usuário autenticado");
        }
    }

    public function logout(Request $request){
        try {
            Auth::logout();
            return $this->responseOk("Usuário deslogado com sucesso.");
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao deslogar usuário autenticado");
        }
    }
}
