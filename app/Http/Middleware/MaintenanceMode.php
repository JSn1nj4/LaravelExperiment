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
        if($this->shouldRedirect($request)) {
            return redirect()->route('maintenance');
        }

        if($this->shouldRedirectHome($request)) {
            return redirect()->route('home');
        }

        return $next($request);
    }

    /**
     * Check if the user should be redirected
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     *
     * This method is used to check if the user should be redirected to the
     * Coming Soon page. This method is used in place of inlining the below
     * expression within an if statement.
     */
    private function shouldRedirect($request)
    {
        return config('app.maintenance')
            && !config('app.coming_soon')
            && !$request->is('maintenance');
    }

    /**
     * Check if the user should be redirected home
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     *
     * This method is used to check if the user should be redirected to the
     * homepage instead. Similar to the previous method, this method is used
     * in place of inlining the below logic in an `if` statement.
     *
     * Also, the reason for the last part of the expression is that I want to be
     * able to manually open the Coming Soon page in case I need to work on it.
     *
     * Lastly, this method will prevent redirecting to the homepage if the
     * Coming Soon setting is on.
     */
    private function shouldRedirectHome($request)
    {
        return !config('app.maintenance')
            && $request->is('/maintenance')
            && !(config('app.env') === 'local');
    }
}
