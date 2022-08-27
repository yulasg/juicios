<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Juicio;

class DatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $observacion = $this->faker->text();
        return [
            //
            'juicio_id' => Juicio::all()->unique()->random()->id,
            'observacion' => $observacion,
            'demanda' => $this->faker->date(),
            'asignacion' => $this->faker->date(),
            'actuacion' => $this->faker->date(),
            'actividad' => $this->faker->date(),
          
        ];
    }
}
