<?php

namespace App\Providers;

use App\Models\Permission;
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
        Gate::define('manage-users', function (User $user) {
            return $user->hasAnyPermission(['user:create', 'permission:create']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // foreach (Permission::all() as $permission) {
        //     Gate::define($permission->name, function ($user) use ($permission) {
        //         return $user->hasPermissionTo($permission->name);
        //     });
        // }
    }
}
