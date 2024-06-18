<?php

namespace App\Http\Middleware;

use App\Utils\Functions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OperatorAccess {
    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) {
        $routePah = $request->path();
        $user = $request->user();
        $user3 = Auth::check() ? Auth::user() : null;

        if(Functions::nullOrEmpty($user) && in_array($routePah, ['/', 'login', 'authenticate']))
            return $next($request);
        else if(Functions::nullOrEmpty($user)) {
            Session::flash('flash-danger-msg', "Usuário Não possui acesso a este recurso.");
            return redirect('/');
        }

        if($user->access_operator == 'N' && $user->access_admin == 'N'){
            Session::flash('flash-danger-msg', "Usuário Não possui acesso a este recurso.");
            return redirect()->back();
        }

        if($user->access_operator == 'S' && $user->access_admin == 'N'){
            $routesAccessible = [
                '/',
                'login',
                'authenticate',
                'logout',
                'home',
                'setor/listar',
                'classificacao/listar',
                'checklist/listar',
                'checklist-item/listar/checklist',
                'grupo-usuarios/listar',
                'usuario/listar',
                'unidade/listar',
                'gerenciar/tarefas/listar',
                'gerenciar/visualizar-tarefa',
                'gerenciar/get-report-task',
            ];

            if(in_array($routePah, $routesAccessible)){
                return $next($request);
            }else {
                Session::flash('flash-danger-msg', "Usuário Não possui acesso a este recurso.");
                return redirect()->back();
            }
        }else
            return $next($request);
    }
}
