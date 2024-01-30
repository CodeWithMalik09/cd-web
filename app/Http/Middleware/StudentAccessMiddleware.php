<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentAccessMiddleware
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
        $admin = session('user');
        if($admin){
            return $next($request);
        }else{
            return redirect('login')->with('message','Access Denied!');
        }
    }
}
