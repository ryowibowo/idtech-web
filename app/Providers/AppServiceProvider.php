<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        if ($this->app->isLocal()) {
            //if local register your services you require for development
            \URL::forceScheme('http');
        } else {
            //else register your services you require for production
            \URL::forceScheme('https');
        }
    }

}
