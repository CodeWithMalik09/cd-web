<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccessMiddleware
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
        $admin = session('admin');
        if($admin && auth()->user()->role != "student"){
            return $next($request);
        }else{
            return redirect('cms')->withError('Access Denied');
        }
    }
}
