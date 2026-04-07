<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\CompanyInfoComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register company info composer for admin layouts
        View::composer([
            'admin.layout-simple',
            'admin.layout-fixed',
            'admin.dashboard-minimal'
        ], CompanyInfoComposer::class);
    }
}
