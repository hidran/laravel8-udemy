<?php

namespace App\Http\Middleware;

use Closure, Auth;
use Illuminate\Http\Request;

class VerifyIsAdmin
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
        if(!Auth::user()->isAdmin()){

            abort(401);
        }
        return $next($request);
    }
}
