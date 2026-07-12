<?php

use App\Enums\UserRole;
use App\Models\User;

test('Un master admin o admin registrado puede ver la pantalla de registro', function () {
    $master = User::factory()->create(['role' => UserRole::Master]);

    $response = $this->actingAs($master)->get('/admin');

    $response->assertViewIs('admin_layout.dashboard')
        ->assertViewHas('establecimientos');

});
