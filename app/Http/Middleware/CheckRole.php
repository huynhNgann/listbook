<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      /* $user=Auth::user();
         if($user->role->name=='subscriber')
             return redirect('/');*/
        if(Auth::check()){
            $user=Auth::user();
            if($user->role->name=="subscriber"){
                return redirect('/');
            }
        }else{
            return redirect('login');
        }
        return $next($request);
    }
}
