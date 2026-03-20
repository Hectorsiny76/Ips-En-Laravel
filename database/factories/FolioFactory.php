<?php

namespace Database\Factories;

use App\Models\Foliotipo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Folio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folio>
 */
class FolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Folio::create([
                'numero'=>fake()->word().' Folio',
                'foliotipo_id'=>Foliotipo::factory(),
                'titulo'=>'Un problema con '.fake()->word(),
                'descripcion'=>fake()->sentence(),
            ])
        ];
    }
}
