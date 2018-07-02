<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('getMessage' , function($message, $isCenter = true) {

            if($isCenter) {
                return "<center><p> $message</p></center>";
            } else {
                return "<p> $message</p>";
            }
        });

        DB::listen(function($query) {

            //dump($query->sql);
            //dump($query->bindings);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
