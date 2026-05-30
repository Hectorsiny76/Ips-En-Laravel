<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {

        $currentUser = $request->user();
        $allowedRoles = [];

        if($currentUser->isMasterAdmin()){
            $allowedRoles = [UserRole::Admin, UserRole::SubAdmin];
        } else if($currentUser->isAdmin()){
            $allowedRoles = [UserRole::SubAdmin];
        }

        return view('auth.register', compact('allowedRoles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('delete-data-create-users');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::enum(UserRole::class)],
        ]);

        // ¿Qué tipo de admin está tratando de guardar?
        $currentUser = $request->user();
        $requestedRole = UserRole::from($request->role);

        // Confirmación de permisos
        if($requestedRole === UserRole::Master){
            abort(403, 'No se puede crear un Administrador Master desde el Dashboard');
        } else if($requestedRole === UserRole::Admin && !$currentUser->isMasterAdmin()){
            abort(403, 'No se puede crear un Admin siendo de nivel Admin');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect(route('admin.admin_layout.dashboard'))->with('success', 'Se ha registrado un nuevo usuario.');
    }
}
