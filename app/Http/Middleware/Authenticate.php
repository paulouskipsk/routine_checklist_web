<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware {
    protected function redirectTo(Request $request): ?string {

        if($request->expectsJson()){
            return null;
        }else{
            Session::flash('flash-error-msg', "É preciso estar autenticado para acessar este recurso!");
            return route('login');
        }
    }
}
