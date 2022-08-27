<?php

namespace Database\Factories;

use App\Models\Juicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = $this->faker->name();
        return [
            //
            'juicio_id' => Juicio::all()->random()->id,
            'nombre' => $nombre,
            'tipo' => $this->faker->randomElement(['DEMANDADOS','DEMANDANTES']),

        ];
    }
}
