<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use App\Models\Role;

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
        RateLimiter::for('authentication', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        Gate::define('admin-access', function (User $user) {
            $administrator_role = Role::where('name', 'Administrator')->firstOrFail();

            return $user->role_id === $administrator_role->id;
        });

        Gate::define('editor-access', function (User $user) {
            $editor_role = Role::where('name', 'Editor')->firstOrFail();

            return $user->role_id === $editor_role->id;
        });
    }
}
