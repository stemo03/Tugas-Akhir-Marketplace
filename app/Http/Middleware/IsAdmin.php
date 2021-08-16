<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User_roles;

use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        
        $roles = User_roles::with(['role', 'user'])->whereHas('user', function($q){
            $q->where('id', Auth::user()->id);
        })->first();

        if(Auth::user() && $roles->role->name =='ADMIN'){
             return $next($request);
        }
        

        return redirect('/');


       
    }
}
