<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share company info with all admin views
        View::composer('admin.*', function ($view) {
            if (!$view->offsetExists('company')) {
                $company = CompanyInfo::where('is_active', 1)->first();
                $view->with('company', $company);
            }
        });
    }
}
