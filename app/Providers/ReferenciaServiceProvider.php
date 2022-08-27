<?php

namespace App\Providers;

use App\Clases\ReferenciaClass;
use Illuminate\Support\ServiceProvider;

class ReferenciaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
         /*
        $this->app->bind(ReferenciaClass::class, function ($app) {
            return new ReferenciaClass('V', '12292784', '5');
        });
        $this->app->singleton(ReferenciaClass::class, function ($app) {
            return new ReferenciaClass('V','122927845','');
        });
        */

        /*
        $this->app->singleton(
            'test1',
            \App\Clases\TestClass::class
        );
    
        $this->app->bind(
            'test2',
            \App\Clases\TestClass::class
        );
         */
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
