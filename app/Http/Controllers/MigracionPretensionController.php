<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabla;
use App\Models\Pretension;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionPretensionController extends Controller
{
    //
    public function Pretension()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tipo_pretension"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO TODO LO QUE TENGA CODIGO 53 SE CAMBIO POR 47
            // EN JUICIO TODO LO QUE TENGA CODIGO 49 SE CAMBIO POR 1
            if ($datos[$i]->CODIGO  !=  '53'  && $datos[$i]->CODIGO  !=  '49') {
                $paso =  $paso + 1;
                $this->insertPretension($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
            } else {
                $noPaso =  $noPaso + 1;
                $this->insertTabla($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION)) ;
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
        return "salio todo bien pretensión";
    }

    private function insertPretension(int $id, string $descripcion)
    {
        /*
        $pretension = new Pretension();
        $pretension->id = $id;
        $pretension->descripcion = $descripcion;
        $pretension->save();
        */


        DB::table('pretensiones')->insert([
            'id' => $id,
            'descripcion' => trim($descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertTabla(int $id, string $descripcion)
    {
        /*
        $tabla = new Tabla();
        $tabla->tabla = 'pretensiones';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'pretensiones',
            'codigo' => $id,
            'descripcion' =>  trim($descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
