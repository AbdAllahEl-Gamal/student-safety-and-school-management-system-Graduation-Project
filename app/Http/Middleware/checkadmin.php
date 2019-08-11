<?php

namespace App\Http\Middleware;

use Closure;

class checkadmin
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
        if (!(session('status') == 'logged')) {
            return redirect('/');
        }else{
            if (session('position') == 'teacher') {
                return redirect('teacher');
            }
        }
        return $next($request);
    }
}
