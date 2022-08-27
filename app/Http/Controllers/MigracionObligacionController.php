<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Obligacion;
use App\Models\Tabla;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionObligacionController extends Controller
{
    //
    public function Obligacion()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tipo_obligacion"));
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO TODO LO QUE TENGA CODIGO 52 SE CAMBIO POR 49
            // EN JUICIO TODO LO QUE TENGA CODIGO 57 SE CAMBIO POR 1
            if ($datos[$i]->CODIGO  !=  '52'  && $datos[$i]->CODIGO  !=  '57'  ) {
                $paso =  $paso + 1;
                $this->insertObligacion($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien obligación";
    }

    private function insertObligacion(int $id, string $descripcion)
    {
        /*
        $obligacion = new Obligacion();
        $obligacion->id = $id;
        $obligacion->descripcion = $descripcion;
        $obligacion->save();
        */

        DB::table('obligaciones')->insert([
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
        $tabla->tabla = 'obligaciones';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'obligaciones',
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
