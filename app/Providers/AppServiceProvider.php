<?php

namespace App\Providers;

use App\Models\School_class;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        // Use view composers to share $classes variable with the layout
        view()->composer('layout', function ($view) {
            // Fetch classes from the database
            $classes = School_class::all();
            
            // Share the $classes variable with the layout
            $view->with('classes', $classes);
        });
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }
}
