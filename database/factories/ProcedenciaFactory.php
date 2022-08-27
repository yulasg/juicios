<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProcedenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descripcion = $this->faker->name(50);
        return [
            //
            'descripcion' => $descripcion,
        ];
    }
}
