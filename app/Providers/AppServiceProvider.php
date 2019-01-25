<?php

namespace App\Providers;

use App\Observers\PostObserver;
use App\Observers\UserObserver;
use App\Post;
use App\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
//        Resource::withoutWrapping(); // remove key "data" when using eloquent-resources
//        User::creating(function ($user) {
//            Log::info('event creating');
//        });
//
//        User::created(function ($user) {
//            Log::info('event created');
//        });
//
//        User::updating(function ($user) {
//            Log::info('event updating');
//        });
//
//        User::updated(function ($user) {
//            Log::info('event updated');
//        });
//
//        User::saving(function ($user) {
//            Log::info('event saving');
//        });
//
//        User::saved(function ($user) {
//            Log::info('event saved');
//        });
//
//        User::deleting(function ($user) {
//            Log::info('event deleting');
//        });
//
//        User::deleted(function ($user) {
//            Log::info('event deleted');
//        });

        Blade::component('components.alert', 'alert'); // Aliasing Components

        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });

        // Sharing Data With All Views
        View::share('title', 'Giảm cân - Sharing Data With All Views');

        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);

        \Braintree_Configuration::environment(config('services.braintree.environment'));
        \Braintree_Configuration::merchantId(config('services.braintree.merchant_id'));
        \Braintree_Configuration::publicKey(config('services.braintree.public_key'));
        \Braintree_Configuration::privateKey(config('services.braintree.private_key'));
        // Cashier::useCurrency('eur', '€');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
