<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Juzgado;
use App\Models\Tribunal;
use App\Models\Tabla;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionTribunalController extends Controller
{
    //

    public function Tribunal()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tribunales"));
        //return $datos;
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
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 134 SE CAMBIO POR 133
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 207 SE CAMBIO POR 206
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 208 SE CAMBIO POR 206
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 211 SE CAMBIO POR 210
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 212 SE CAMBIO POR 1
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 213 SE CAMBIO POR 210
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 215 SE CAMBIO POR 214
            // EN JUICIO Y TRIBUNAL TODO LO QUE TENGA CODIGO 230 SE CAMBIO POR 225
            $cod = $datos[$i]->CODIGO;
            $juzgado = $datos[$i]->JUZGADO;
            $descripcion = trim($datos[$i]->DESCRIPCION) ;
            switch ($juzgado) {
                case 73:
                    $juzgado = 1;
                    break;
                case 78:
                    $juzgado = 1;
                    break;
                case 79:
                    $juzgado = 1;
                    break;
                case 87:
                    $juzgado = 1;
                    break;
                case 89:
                    $juzgado = 88;
                    break;
                case 101:
                    $juzgado = 95;
                    break;
                case 110:
                    $juzgado = 1;
                    break;
                case 112:
                    $juzgado = 1;
                    break;
                case 114:
                    $juzgado = 113;
                    break;
                case 134:
                    $juzgado = 133;
                    break;
                case 207:
                    $juzgado = 206;
                    break;
                case 208:
                    $juzgado = 206;
                    break;
                case 211:
                    $juzgado = 210;
                    break;
                case 212:
                    $juzgado = 1;
                    break;
                case 213:
                    $juzgado = 210;
                    break;
                case 215:
                    $juzgado = 214;
                    break;
                case 230:
                    $juzgado = 225;
                    break;
                default:
                    $juzgado = $juzgado;
                    break;
            };


            $tribunal  = DB::table('tribunales')
                ->where('juzgado_id', $juzgado)
                ->where('descripcion', trim($descripcion) )
                ->select('tribunales.*')->get();
            if (count($tribunal) > 0) {
                // TRIBUNAL 308 CAMBIAR EN JUICIO 307
                // TRIBUNAL 337 CAMBIAR EN JUICIO 336
                // TRIBUNAL 469 CAMBIAR EN JUICIO 467
                // TRIBUNAL 473 CAMBIAR EN JUICIO 472
                // TRIBUNAL 494 CAMBIAR EN JUICIO 492
                $noPaso =  $noPaso + 1;
                $this->insertTabla($datos[$i]->CODIGO,    $juzgado, trim($descripcion) );
            } else {
                if ($cod == '365'  ||  $cod == '611' ){
                    $noPaso =  $noPaso + 1;
                    $this->insertTabla($datos[$i]->CODIGO,    $juzgado, trim($descripcion) );
                }else{
                    $paso =  $paso + 1;
                    $this->insertTribunal($datos[$i]->CODIGO,    $juzgado,  trim($descripcion));
                }
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
        return "salio todo bien tribunal";
    }

    private function insertTribunal(int $CODIGO, int $JUZGADO,  string $DESCRIPCION)
    {
        /*
        $tribunal = new Tribunal();
        $tribunal->id = $CODIGO;
        $tribunal->juzgado_id = $JUZGADO;
        $tribunal->descripcion = $DESCRIPCION;
        $tribunal->save();
        */

        DB::table('tribunales')->insert([
            'id' => $CODIGO,
            'descripcion' => trim($DESCRIPCION) ,
            'juzgado_id' => $JUZGADO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertTabla($CODIGO,  $JUZGADO,  $DESCRIPCION)
    {
        /*
        $tabla = new Tabla();
        $tabla->tabla = 'tribunal';
        $tabla->codigo = $CODIGO;
        $tabla->descripcion = $JUZGADO . ' - ' . $DESCRIPCION;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'tribunales',
            'codigo' => $CODIGO,
            'descripcion' =>  $JUZGADO . ' - ' . trim($DESCRIPCION) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
