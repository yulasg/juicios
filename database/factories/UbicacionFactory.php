<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class UbicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descripcion = $this->faker->unique()->name(50);
        return [
            //
            'descripcion' => $descripcion,
            //'slug' => Str::slug($descripcion, '-'),
        ];
    }
}
