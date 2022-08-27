<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interno;
use Illuminate\Support\Facades\Http;
use App\Models\Tabla;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionInternoController extends Controller
{
    //
    public function Interno()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/abogados_internos"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO TODO LO QUE TENGA CODIGO 36 SE CAMBIO POR 34
            // EN JUICIO TODO LO QUE TENGA CODIGO 39 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 53 SE CAMBIO POR 52
            // EN JUICIO TODO LO QUE TENGA CODIGO 60 SE CAMBIO POR 14
            // EN JUICIO TODO LO QUE TENGA CODIGO 70 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 77 SE CAMBIO POR 76
            // EN JUICIO TODO LO QUE TENGA CODIGO 109 SE CAMBIO POR 108
            if ($datos[$i]->CODIGO  !=  '36'  && $datos[$i]->CODIGO  !=  '39' && $datos[$i]->CODIGO  !=  '53' && $datos[$i]->CODIGO  !=  '60' &&  $datos[$i]->CODIGO  !=  '70' && $datos[$i]->CODIGO  !=  '77' && $datos[$i]->CODIGO  !=  '109'  ) {
                $paso =  $paso + 1;
                $this->insertInterno($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
            }else{
                $noPaso =  $noPaso + 1;
                $this->insertTabla($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION));
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
        return "salio todo bien interno";
    }

    private function insertInterno(int $id, string $descripcion)
    {
        /*
        $interno = new Interno();
        $interno->id = $id;
        $interno->nombre = $descripcion;
        $interno->save();
        */

        DB::table('internos')->insert([
            'id' => $id,
            'nombre' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertTabla(int $id, string $descripcion)
    {
        /*
        $tabla = new Tabla();
        $tabla->tabla = 'internos';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'internos',
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
