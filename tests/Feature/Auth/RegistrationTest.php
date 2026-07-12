<?php

use App\Enums\UserRole;
use App\Models\User;

test('la pantalla de registro no se puede acceder sin login', function () {
    $response = $this->get('/admin/register');

    $response->assertStatus(302); // Sin acceso
});

test('la pantalla de registro se puede acceder desde un master admin', function () {
    $master = User::factory()->create(['role'=>UserRole::Master]);

    $response = $this->actingAs($master)->get('/admin/register');

    $response->assertStatus(200); // con acceso
});

test('un master admin puede registrar otros admins o subadmin', function () {

    $master = User::factory()->create(['role'=>UserRole::Master]);

    $response = $this->actingAs($master)->post('/admin/register', [
        'name' => 'Test User',
        'role' => UserRole::Admin->value,
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('admin.admin_layout.dashboard'));
});
