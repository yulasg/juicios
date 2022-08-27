<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class EstatuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $descripcion = $this->faker->name();
       return [
        //
        'terminado' => $this->faker->randomElement(['S', 'N']),
        'descripcion' => $descripcion,
    ];
    }
}
