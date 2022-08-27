<?php

namespace App\Http\Controllers;

use App\Models\Tabla;
use App\Models\Demanda;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MigracionDemandaController extends Controller
{
    //
    public function Demanda()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tipo_demanda"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO TODO LO QUE TENGA CODIGO 78 SE CAMBIO POR 2
            // EN JUICIO TODO LO QUE TENGA CODIGO 40 SE CAMBIO POR 38
            if ($datos[$i]->CODIGO  !=  '78'  && $datos[$i]->CODIGO  !=  '40') {
                $paso =  $paso + 1;
                $this->insertDemanda($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
            } else {
                $noPaso =  $noPaso + 1;
                $this->insertTabla($datos[$i]->CODIGO,  trim($datos[$i]->DESCRIPCION));
            }
        }
        echo 'Cantidad de Registros: ' . count($datos);
        echo "<br>";
        echo "<br>";
        echo 'Total Registros Migrados: ' . $paso;
        echo "<br>";
        echo "<br>";
        echo 'Total Registros No Migrados: ' . $noPaso;
        echo "<br>";
        echo "<br>";
        $total =  $paso + $noPaso;
        echo 'Total Migrados + No Migrados: ' . $total;
        echo "<br>";
        echo "<br>";
        return "salio todo bien demanda";
    }

    private function insertDemanda(int $id, string $descripcion)
    {
        /*
        $demanda = new Demanda();
        $demanda->id = $id;
        $demanda->descripcion = $descripcion;
        $demanda->save();
        */

        DB::table('demandas')->insert([
            'id' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertTabla(int $id, string $descripcion)
    {
        /*
        $tabla = new Tabla();
        $tabla->tabla = 'demandas';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'demandas',
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            "created_at" => Carbon::now(), # new \Datetime()
            "updated_at" => Carbon::now(),  # new \Datetime()
        ]);
    }
}
