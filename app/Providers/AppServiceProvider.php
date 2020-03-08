<?php

namespace App\Providers;

use App\Observers\ProblemObserver;
use App\Problem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Laravel\Nova\Nova;

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
        Nova::serving(function () {

            Problem::observe(ProblemObserver::class);

        });

        /*Schema::defaultStringLength(199);*/
    }
}
