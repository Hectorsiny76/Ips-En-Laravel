<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archivotipo>
 */
class ArchivotipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tipos = ['Link', 'Doc'];

        return [
            'nombre'=>fake()->randomElement($tipos),
        ];
    }
}
