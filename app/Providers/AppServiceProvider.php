<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('show_administration', function (User $user) {

            return in_array($user->role,['superadmin','admin','boss']);
        });

        Gate::define('show_superadmin_interface', function (User $user) {

            return in_array($user->role,['superadmin','boss']);
        });
    }
}
