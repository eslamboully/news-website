<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use mysql_xdevapi\Session;

class language
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
        if (session()->has('lang')){
            App()->setLocale(session('lang'));
        }else{
            session()->put('lang','ar');
            App()->setLocale(session('lang'));
        }
        return $next($request);
    }
}
