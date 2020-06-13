<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->store()->count()){//se for true, vai retornar 1. significando que o usuario ja tem loja, entao ele nao podera entrar na pagina para criar outra loja
            flash('Voce já possui uma loja cadastrada')->warning();
            return redirect()->route('admin.stores.index');
        }
        return $next($request);
    }
}
