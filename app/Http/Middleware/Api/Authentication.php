<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $admin = auth()->guard('admin')->user()->get();
            return $next->$request;
        }else{
            return res_api(null,405,'not allow for guest to access this page login first');
        }
    }
}
