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
            $validateUser = Validator::make($request->all(), 
            [
                'login' => 'required',
                'password' => 'required'
            ]);            

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['login', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'login & Senha não conferem.',
                ], 401);
            }

            $user = User::where('login', $request->login)->first();

            return response()->json([
                'status' => true,
                'message' => "Você fez login com o usuário: $user->name, Seja bem vindo.",
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
