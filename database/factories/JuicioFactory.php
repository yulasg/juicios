<?php

namespace Database\Factories;

use App\Models\Demanda;
use App\Models\Especialidad;
use App\Models\Estado;
use App\Models\Estatu;
use App\Models\Externo;
use App\Models\Garantia;
use App\Models\Interno;
use App\Models\Medida;
use App\Models\Obligacion;
use App\Models\Pretension;
use App\Models\Procedencia;
use App\Models\Tribunal;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class JuicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $expediente = $this->faker->name();
        return [
            //
            //'observacion' => $observacion,
            //'internacional' => $this->faker->boolean(),
            'internacional' => $this->faker->randomElement(['N', 'I']),
            'especialidad_id' => Especialidad::all()->random()->id,
            'origen' => $this->faker->randomElement(['F', 'B', 'A', 'C']),
            'procedencia_id' => Procedencia::all()->random()->id,
            'ubicacion_id' => Ubicacion::all()->random()->id,
            'estatu_id' => Estatu::all()->random()->id,
            'expediente' => $expediente,
            'tribunal_id' => Tribunal::all()->random()->id,
            'interno_id' => Interno::all()->random()->id,
            'externo_id' => Externo::all()->random()->id,
            'obligacion_id' => Obligacion::all()->random()->id,
            'estado_id' => Estado::all()->random()->id,
            //'proceso_id' => Proceso::all()->random()->id,
            'demanda_id' => Demanda::all()->random()->id,
            'pretension_id' => Pretension::all()->random()->id,
            'garantia_id' => Garantia::all()->random()->id,
            'llevado' => $this->faker->randomElement(['CJ', 'AE']),
            'medida_id' => Medida::all()->random()->id,
            'practicada' => $this->faker->randomElement(['S', 'N']),
            'moneda' => $this->faker->randomElement(['BS', 'US']),
            'admision' => $this->faker->date(),
            'asignacion' => $this->faker->date()
        ];
    }
}
