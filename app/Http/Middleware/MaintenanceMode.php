<?php

namespace App\Http\Middleware;

use Closure;

class MaintenanceMode
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
        if(config('app.maintenance') && !$request->is('maintenance') && !$request->is('coming-soon')) {
            return redirect()->route('maintenance');
        }

        return $next($request);
    }
}
