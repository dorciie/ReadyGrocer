<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShopAlreadyLoggedIn
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
        if( session()->has('LoggedShop') && ( url('shop/shoplogin') == $request->url() ) ){
            //return back();
            return redirect('shop/shopdashboard');
        }
        return $next($request);
    }
}
