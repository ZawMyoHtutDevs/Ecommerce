<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Auth;

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
        Schema::defaultStringLength(191);
        Blade::if('admin', function () {
            return auth()->user()->utype === 'ADM';
        });
        Blade::if('staff', function () {
            return auth()->user()->utype === 'ADM' || auth()->user()->utype === 'STA';
        });
        Blade::if('customer', function () {
            return auth()->user()->utype === 'ADM' || auth()->user()->utype === 'STA' || auth()->user()->utype === 'CUS';
        });

    }
}
