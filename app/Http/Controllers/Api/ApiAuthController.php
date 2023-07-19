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

    public function user(Request $request){
        $user = Auth::user();
    }
}
