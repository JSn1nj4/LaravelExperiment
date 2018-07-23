<?php

namespace App\Http\Middleware;

use Closure;

class ComingSoon
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
        if(config('app.coming_soon') && !$request->is('coming-soon')) {
            return redirect()->route('coming-soon');
        }

        if(!config('app.coming_soon') && !$request->is('/') && !(config('app.env') === 'local')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
