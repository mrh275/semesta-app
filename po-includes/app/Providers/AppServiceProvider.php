<?php

namespace App\Providers;

use App\Theme;
use Illuminate\Pagination\Paginator;
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
        $themes = Theme::where('active', 'Y')->first();
        Paginator::defaultView('frontend.' . $themes->folder . '.partials.pagination');
        Paginator::defaultSimpleView('frontend.' . $themes->folder . '.partials.pagination');
    }
}
