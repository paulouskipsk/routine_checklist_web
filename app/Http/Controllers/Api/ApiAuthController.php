<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ControllerApi;
use App\Models\Unity;
use App\Models\User;
use App\Utils\Functions;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ApiAuthController extends ControllerApi
{
    public function authenticate(Request $request) {
        try {            
            if(!Auth::attempt($request->only(['login', 'password'])))
                return $this->response(false, 401, "Login ou senha não conferem");
            
            $user = User::where('login', $request->login)->first();
            if($user->access_mobile =='N') throw new Exception("Este usuário não tem acesso ao aplicativo mobile!");

            $unity = Unity::find($request->unity);
            if(!$user->units->contains($unity)) throw new Exception("Usuário não tem acesso à unidade selecionada!");
            $user->unity_logged = $unity->id;
            $plainTextToken = $user->createToken("API TOKEN")->plainTextToken;
            $user->save();

            return $this->responseOk("Seja bem vindo, $user->name.", ['token'=>$plainTextToken, 'unity'=>$unity, 'user'=>$user]);
        } catch (Throwable $th) {
            return $this->responseError("Erro ao efetuar login: ". $th->getMessage(), [
                'message'=>$th->getMessage(),
                'file'=>$th->getFile(),
                'line'=>$th->getLine(),
                'stack'=>$th->getTraceAsString()
            ]);
        }
    }

    public function getUserDataByCredentials(Request $request){
        try {
            if(!Auth::attempt($request->only(['login', 'password'])))
                return $this->response(false, 401, "Login ou senha não conferem");
            
            $user = User::where('login', $request->login)->first();
            if($user->access_mobile =='N') throw new Exception("Este usuário não tem acesso ao aplicativo mobile!");

            return $this->responseOk("Usuário recuperado com sucesso", ['user'=>$user, 'units'=>$user->units]);
        } catch (\Throwable $th) {
            return $this->responseError("Atenção! ". $th->getMessage());
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
            Auth::user()->tokens()->delete();
            return $this->responseOk("Usuário deslogado com sucesso.");
        } catch (\Throwable $th) {
            return $this->responseError("Erro ao deslogar usuário autenticado");
        }
    }
}
