<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Juzgado;


class TribunalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descripcion = $this->faker->word(50);
        return [
            //
            'descripcion' => $descripcion,
            //'slug' => Str::slug($descripcion, '-'),
            'juzgado_id' => Juzgado::all()->random()->id,
        ];
    }
}
