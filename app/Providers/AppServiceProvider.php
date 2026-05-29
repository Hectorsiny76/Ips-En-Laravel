<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\Establecimientotipo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        if (Schema::hasTable('establecimientotipos')) {
            View::share('navEstablecimientos', Establecimientotipo::all());
        }

        Gate::define('delete-data-create-users', function (User $user) {
           return $user->isMasterAdmin();
        });

        Gate::define('manage-general-data', function (User $user) {
            return $user->isSubAdmin();
        });

    }
}
