<?php

namespace App\Providers;

use App\Phone;
use App\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Load Categories in sidebar views
         */
        view()->composer('layouts.includes.side-bar', function ($view){

            $categories = Category::with('phones')->orderBy('name', 'asc')->get();
            return $view->with('categories', $categories);
        });

        /*
         * Load Recent phones in  sidebar views
         */
        view()->composer('layouts.includes.side-bar', function ($view){
            $recentPhones = Phone::latestFirst()->take(4)->get();
            return $view->with('recent_phones', $recentPhones);
        });


    }
}
