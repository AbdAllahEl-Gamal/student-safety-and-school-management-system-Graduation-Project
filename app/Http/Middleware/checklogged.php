<?php

namespace App\Http\Middleware;

use Closure;

class checklogged
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
        }
        return $next($request);
    }
}