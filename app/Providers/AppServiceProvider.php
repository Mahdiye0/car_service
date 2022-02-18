<?php

namespace App\Providers;

use App\CustomClass\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {

            if (Auth::check()) {
                $type=(CheckRole::check( Auth::user()->id));

             view()->share('type', $type);
            }
        });





    }
}
