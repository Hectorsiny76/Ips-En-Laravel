<?php

use App\Enums\UserRole;
use App\Models\User;

test('Un admin master registrado puede acceder al uri /admin', function () {

    $master = User::factory()->create(['role' => UserRole::Master]);

    $response = $this->actingAs($master)->get('/admin');

    $response->assertStatus(200);

});
