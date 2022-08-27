<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Externo;
use App\Models\Tabla;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionExternoController extends Controller
{
    //
    public function Externo()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/abogados_externos"));
        //return  $datos;
        for ($i = 0; $i < count($datos); ++$i) {

            /*
            if ($datos[$i]->DIRECCION  != '' || $datos[$i]->NATURALEZA  != ''   || $datos[$i]->TELEFONO_OFICINA  != '' || $datos[$i]->TELEFONO_CELULAR  != ''  || $datos[$i]->TELEFONO_HABITACION  != '' || $datos[$i]->TELEFONO_FAX  != '' || $datos[$i]->CORREO_ELECTRONICO  != ''  ){
                $paso =  $paso + 1;
                echo "<br>";
                echo $datos[$i]->CODIGO . '- '. $datos[$i]->NATURALEZA . '- '. $datos[$i]->TELEFONO_OFICINA . '- '. $datos[$i]->TELEFONO_CELULAR . '- '. $datos[$i]->TELEFONO_HABITACION . '- '. $datos[$i]->TELEFONO_FAX  . '- '. $datos[$i]->CORREO_ELECTRONICO  . '- '. $datos[$i]->DIRECCION ;
                echo "<br>";

            }
            */
            
            // EN JUICIO TODO LO QUE TENGA CODIGO 326 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 382 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 397 SE CAMBIO POR 396
            // EN JUICIO TODO LO QUE TENGA CODIGO 413 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 415 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 436 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 437 SE CAMBIO POR 435
            // EN JUICIO TODO LO QUE TENGA CODIGO 439 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 451 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 462 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 463 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 468 SE CAMBIO POR 1
            
            if (
                $datos[$i]->CODIGO  !=  '326'  && $datos[$i]->CODIGO  !=  '382'
                && $datos[$i]->CODIGO  !=  '397' && $datos[$i]->CODIGO  !=  '415'
                && $datos[$i]->CODIGO  !=  '436' && $datos[$i]->CODIGO  !=  '413'
                && $datos[$i]->CODIGO  !=  '437' && $datos[$i]->CODIGO  !=  '451'
                && $datos[$i]->CODIGO  !=  '462' && $datos[$i]->CODIGO  !=  '439'
                && $datos[$i]->CODIGO  !=  '463' && $datos[$i]->CODIGO  !=  '468'
            ) {
                $paso =  $paso + 1;
                $this->insertExterno($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION));
            } else {
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
        
        return "salio todo bien externo";
    }

    private function insertExterno(int $id, string $descripcion)
    {
        /*
        $externo = new Externo();
        $externo->id = $id;
        $externo->nombre = $descripcion;
        $externo->save();
        */

        DB::table('externos')->insert([
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
        $tabla->tabla = 'externos';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'externos',
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
