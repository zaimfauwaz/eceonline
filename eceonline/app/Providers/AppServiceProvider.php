<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        // Admin Powers
        Gate::define('manage-cars', function ($user) {
            return $user->role === 9;
        });

        Gate::define('manage-users', function ($user) {
            return $user->role === 9;
        });

        Gate::define('manage-branches', function ($user) {
            return $user->role === 9;
        });

        // Staff Powers
        Gate::define('manage-bookings', function ($user) {
            return $user->role === 3;
        });

        // Customer Powers
        Gate::define('check-bookings', function ($user) {
            return $user->role === 7;
        });

    }
}
