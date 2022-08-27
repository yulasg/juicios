<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
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
        //
        Carbon::setLocale('es');
        //Carbon::setUtf8(true);
        setlocale(LC_TIME, 'es_ES.UTF-8');
        //Paginator::useBootstrapThree();
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
    }
}
