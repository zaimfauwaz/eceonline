<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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

        // Share mainBranch globally
        View::composer('*', function ($view) {
            $mainBranch = \App\Models\Branch::where('branch_id', 1)->first();
            $view->with('mainBranch', $mainBranch);
        });
    }
}
