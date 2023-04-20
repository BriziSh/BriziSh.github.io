<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
//shtoj
use Closure;
use Auth;
class Authenticate extends Middleware
{
        /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */

     public function handle($request, Closure $next, ...$guards)
     {
         if (Auth::check() && Auth::user()->usertype==$guards[0]){
             return $next($request);
         }
         return redirect()->route('loginUser')->with('danger', 'You should\ login first');
     }

}
