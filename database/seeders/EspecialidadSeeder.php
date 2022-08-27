<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use Illuminate\Database\Seeder;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //17
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Fogade";
        $especialidad->save();
        //18
        $especialidad = new Especialidad();
        $especialidad->internacional = "I";
        $especialidad->descripcion = "Fogade";
        $especialidad->save();
        //1
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Penal";
        $especialidad->save();
        //2
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Mercantil";
        $especialidad->save();
        //3
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Constitucional";
        $especialidad->save();
        //4
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Contencioso Administrativa";
        $especialidad->save();
        //5
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Laboral";
        $especialidad->save();
        //6
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Tributario";
        $especialidad->save();
        //7
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Internacional Público";
        $especialidad->save();
        //8
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Internacional Privado";
        $especialidad->save();
        //9
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Civil";
        $especialidad->save();
        //10
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Agrario";
        $especialidad->save();
        //11
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Marítimo";
        $especialidad->save();
        //12
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "De Tránsito";
        $especialidad->save();
        //13
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Financiero";
        $especialidad->save();
        //14
        $especialidad = new Especialidad();
        $especialidad->internacional = "N";
        $especialidad->descripcion = "Protección del Niño, Niña o Adolescente";
        $especialidad->save();
        //15
        $especialidad = new Especialidad();
        $especialidad->internacional = "I";
        $especialidad->descripcion = "Internacional Público";
        $especialidad->save();
        //16
        $especialidad = new Especialidad();
        $especialidad->internacional = "I";
        $especialidad->descripcion = "Internacional Privado";
        $especialidad->save();
    }
}
