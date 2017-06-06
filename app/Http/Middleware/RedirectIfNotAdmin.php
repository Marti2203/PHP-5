<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
class RedirectIfNotAdmin
{
    public function handle($request, Closure $next)
    {
       if(Auth::user()==null || Auth::user()->administration_level<Config::get('constants.administratorLevel'))
       return redirect('/');

       return $next($request);
    }
}
