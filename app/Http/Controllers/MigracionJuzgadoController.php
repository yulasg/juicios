<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juzgado;
use App\Models\Tabla;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MigracionJuzgadoController extends Controller
{
    //
    public function Juzgado()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/juzgados"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 73 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 78 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 79 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 87 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 89 SE CAMBIO POR 88
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 101 SE CAMBIO POR 95
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 110 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 112 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 114 SE CAMBIO POR 113
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 207 SE CAMBIO POR 206
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 208 SE CAMBIO POR 206
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 211 SE CAMBIO POR 210
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 212 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 213 SE CAMBIO POR 210
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 215 SE CAMBIO POR 214
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 230 SE CAMBIO POR 225
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 134 SE CAMBIO POR 133
            if (
                $datos[$i]->CODIGO  !=  '73'  && $datos[$i]->CODIGO  !=  '78' &&
                $datos[$i]->CODIGO  !=  '79'   && $datos[$i]->CODIGO  !=  '87' &&
                $datos[$i]->CODIGO  !=  '89' && $datos[$i]->CODIGO  !=  '101' &&
                $datos[$i]->CODIGO  !=  '110'  && $datos[$i]->CODIGO  !=  '112' &&
                $datos[$i]->CODIGO  !=  '114' && $datos[$i]->CODIGO  !=  '207' &&
                $datos[$i]->CODIGO  !=  '208'  && $datos[$i]->CODIGO  !=  '211'  &&
                $datos[$i]->CODIGO  !=  '212' && $datos[$i]->CODIGO  !=  '213' &&
                $datos[$i]->CODIGO  !=  '215'  && $datos[$i]->CODIGO  !=  '230'  &&
                $datos[$i]->CODIGO  !=  '134'  && $datos[$i]->CODIGO  !=  '186'
            ) {
                $paso =  $paso + 1;
                $this->insertJuzgado($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION));
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
        return "salio todo bien juzgados";
    }

    private function insertJuzgado(int $id, string $descripcion)
    {
        /*
        $juzgado = new Juzgado();
        $juzgado->id = $id;
        $juzgado->descripcion = $descripcion;
        $juzgado->save();
        */

        DB::table('juzgados')->insert([
            'id' => $id,
            'descripcion' => trim( $descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertTabla(int $id, string $descripcion)
    {
        /*
        $tabla = new Tabla();
        $tabla->tabla = 'juzgados';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'juzgados',
            'codigo' => $id,
            'descripcion' =>  trim( $descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
