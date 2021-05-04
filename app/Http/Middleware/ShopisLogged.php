<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShopisLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!session()->has('LoggedShop')){
            return redirect('shop/shoplogin')->with('fail','You must login');
        }
        return $next($request);
    }
}
