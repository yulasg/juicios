<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PretensionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descripcion = $this->faker->unique()->word(50);
        return [
            //
            'descripcion' => $descripcion,
            //'slug' => Str::slug($descripcion, '-'),
        ];
    }
}
