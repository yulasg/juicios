<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabla;
use App\Models\Actividad;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionActividadController extends Controller
{
    //
    public function Actividad()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/actividad_procesal"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN SEGUIMIENTO TODO LO QUE TENGA CODIGO 34 SE CAMBIA POR 1
            if ($datos[$i]->CODIGO  !=  '34'   ) {
                $paso =  $paso + 1;
                $this->insertActividad($datos[$i]->CODIGO, trim( $datos[$i]->DESCRIPCION));
            }else{
                $noPaso =  $noPaso + 1;
                $this->insertTabla($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien actividad";
    }

    private function insertActividad(int $id, string   $descripcion)
    {
        /*
        $actividad = new Actividad();
        $actividad->id = $id;
        $actividad->descripcion = $descripcion;
        $actividad->save();
        */

        DB::table('actividades')->insert([
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
        $tabla->tabla = 'actividades';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'actividades',
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
