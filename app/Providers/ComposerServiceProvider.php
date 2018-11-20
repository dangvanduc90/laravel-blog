<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'child', // call child views
            'App\Http\ViewComposers\ProfileComposer' // with callback
        );
//
//        // Using Closure based composers...
//        View::composer('*', function ($view) {
//            Log::info("Using Closure based composers...");
//        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
