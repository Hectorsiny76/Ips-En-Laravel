<?php

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Livewire;

test('Un admin master puede verse a si mismo en el apartado de admins', function () {

    $master = User::factory()->create(['name' => 'Hector','role' => UserRole::Master]);

    Livewire::actingAs($master)
        ->test('admin::livewire.users.index-table')
        ->assertSee('Hector')
        ->set('search', 'Hola')
        ->assertDontSee('Hector');

});
