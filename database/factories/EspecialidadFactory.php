<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;


class EspecialidadFactory extends Factory
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
            'internacional' => $this->faker->randomElement(['N', 'I']),
            'descripcion' => $descripcion
   
   
        ];
    }
}
