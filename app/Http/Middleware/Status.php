<?php

namespace App\Http\Middleware;

use App\Admin\Setting;
use Closure;

class Status
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
        $setting = Setting::find(1);
        if ($setting->status == 'active'){
            return $next($request);
        }else{
            return redirect()->route('closed_website');
        }
    }
}
