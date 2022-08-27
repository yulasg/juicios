<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExternoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nombre = $this->faker->unique()->word(50);
        return [
            //
            'nombre' => $nombre,
            //'slug' => Str::slug($nombre, '-'),
        ];
    }
}
