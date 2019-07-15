<?php

namespace SistemaDigitalizacion\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(!auth()->users()->privilegios)
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
