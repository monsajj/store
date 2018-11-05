<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SetLocaleBySession
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
        if(!Session::has('locale'))
        {
            Session::put('locale', 'en');
        }

        app()->setLocale(Session::get('locale'));


        return $next($request);
    }
}
