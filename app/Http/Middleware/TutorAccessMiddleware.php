<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TutorAccessMiddleware
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
        $admin = session('tutor');
        if($admin){
            return $next($request);
        }else{
            return redirect('tutorcms/login')->with('message','Access Denied!');
        }
    }
}
