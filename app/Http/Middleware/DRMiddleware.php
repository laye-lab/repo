<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class DRMiddleware
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
        if ( ! $request->user()->is('n+2'))
        {
            return new RedirectResponse(url('/Acceuil'));
        }

        return $next($request);
    }
}
