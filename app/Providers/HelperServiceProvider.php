<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @method                  boot
     * @access public
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @method                  register
     * @access public
     *
     * @return void
     */
    public function register()
    {
        foreach( glob(app_path() . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
