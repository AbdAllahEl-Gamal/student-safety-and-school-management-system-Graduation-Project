<?php

namespace App\Http\Middleware;

use Closure;

class checkposition
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
        if (session('status') == 'logged') {
            if (session('position') == 'admin') {
                return redirect('admin');
            }elseif (session('position') == 'teacher') {
                return redirect('teacher');
            }else{
                //return redirect('logout');
                return redirect('logout');
            }
        }
        return $next($request);
    }
}