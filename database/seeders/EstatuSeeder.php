<?php

namespace Database\Seeders;

use App\Models\Estatu;
use Illuminate\Database\Seeder;

class EstatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estatu = new Estatu();
        $estatu->descripcion = "SIN EJECUTAR";
        $estatu->terminado = "N";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "EN PROCESO";
        $estatu->terminado = "N";
        $estatu->save();

        $estatu = new Estatu();
        $estatu->descripcion = "EXTRA JUDICIAL";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "GANADO";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "PARCIALMENTE GANADO";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "PERDIDO";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "DEVUELTO A SUDEBAN";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "DESISTIDO";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "PERIMIDO";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "MISERABLES< 20000Bs";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "SELECCIONADOS 1";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "SELECCIONADOS 2";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "SELECCIONADOS 3";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "DEVUELTO A CREDITOS";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "MANDAMIENTO DE EJECUCIÓN";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "SIN INFORMACIÓN";
        $estatu->terminado = "S";
        $estatu->save();
        $estatu = new Estatu();
        $estatu->descripcion = "VALOR FUERA DEL RANGO = SE";
        $estatu->terminado = "S";
        $estatu->save();
    }
}
