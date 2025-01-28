<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RollMiddleware
{
   
    public function handle(Request $request, Closure $next, ...$roles) 
    {
        if (!Auth::check()){

           return redirect('/admin/login');
        }
        $user = Auth::user();
        if(!in_array($user->role, $roles)){
            abort(403,'access denied');

        }

        return $next($request);


        
    }
}
