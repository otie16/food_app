<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class Admin
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
    
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

       

        if (Auth::user()->role !== 'admin') {
            return abort(401, 'You are not authorized to perform this request');
        }
 
    }
}
