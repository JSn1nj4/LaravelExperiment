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
        if(config('app.coming_soon')) {
            return redirect()->route('coming-soon');
        }
        
        return $next($request);
    }
}
