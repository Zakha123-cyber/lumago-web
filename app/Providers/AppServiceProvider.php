<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\RedirectBasedOnRole;

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
        // Register the role middleware
        Route::aliasMiddleware('role', CheckRole::class);
        Route::aliasMiddleware('role.redirect', RedirectBasedOnRole::class);
    }
}
