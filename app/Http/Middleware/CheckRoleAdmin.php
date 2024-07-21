<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user=Auth::user();
            if($user->role->name=="admin"){
                return $next($request);
            }
            switch(true){
                case $request->is('book/*'):
                    return redirect('book');
                    break;
                case $request->is('category/*'):
                    return redirect('category');
                    break;
                case $request->is('author/*'):
                    return redirect('author');
                    break;
            }
        }else{
            return redirect('login');
        }
        
    }
}
