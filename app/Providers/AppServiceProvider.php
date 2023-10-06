<?php

namespace App\Providers;

use App\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        View::composer('layouts.template', function($view) {
            $branches = Branch::all();
            if(isset(Auth::user()->admin)) {
                if(Auth::user()->admin) {
                    $view->with(['branches' => $branches]);
                }
            }
        });
    }
}
