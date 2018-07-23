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
        if($this->shouldRedirect($request)) {
            return redirect()->route('coming-soon');
        }

        if($this->shouldNotRedirect($request)) {
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
        return config('app.coming_soon') && !$request->is('coming-soon');
    }

    /**
     * Check if the user should not be redirected
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     *
     * This method is used to check if the user should not be redirected to the
     * Coming Soon page. Similar to the previous method, this method is used
     * in place of inlining the below logic in an `if` statement.
     *
     * Also, the reason for the last part of the expression is that I want to be
     * able to manually open the Coming Soon page in case I need to work on it.
     */
    private function shouldNotRedirect($request)
    {
        return !config('app.coming_soon') && !$request->is('/') && !(config('app.env') === 'local');
    }
}
