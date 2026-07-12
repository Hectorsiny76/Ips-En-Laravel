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

        View::composer('admin_layout.master', function ($view) {
            $view->with('navEstablecimientos', Establecimientotipo::all());
        });

//        if (Schema::hasTable('establecimientotipos')) {
//            View::share('navEstablecimientos', Establecimientotipo::all());
//        }

        Gate::define('delete-admins', function (User $currentUser, User $targetUser) {

            // No se puede eliminar a sí mismo desde el controlador UserController
            if($currentUser->id === $targetUser->id){
                return false;
            }

            // Masters pueden eliminar a quien quiera
            if($currentUser->isMasterAdmin()){
                return true;
            }

            // Admins solo pueden eliminar SubAdmins
            if($currentUser->isAdmin() && $targetUser->role === UserRole::SubAdmin){
                return true;
            }

            // En caso de que no se cumpla ninguno, no se puede realizar la operación de eliminación
            return false;
        });

        Gate::define('delete-data-create-users', function (User $user) {
           return $user->isAdmin();
        });

        Gate::define('manage-general-data', function (User $user) {
            return $user->isSubAdmin();
        });

    }
}
