<?php

namespace App\Http\Controllers;

use App\Models\Tabla;
use App\Models\Estado;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionEstadoController extends Controller
{
    //
    public function Estado()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/estado_procesal"));
        for ($i = 0; $i < count($datos); ++$i) {
            // EN JUICIO TODO LO QUE TENGA CODIGO 122 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 124 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 125 SE CAMBIO POR 123
            // EN JUICIO TODO LO QUE TENGA CODIGO 126 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 128 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 154 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 156 SE CAMBIO POR 1
            // EN JUICIO TODO LO QUE TENGA CODIGO 189 SE CAMBIO POR 188
            if (
                $datos[$i]->CODIGO  !=  '124'  && $datos[$i]->CODIGO  !=  '122'
                && $datos[$i]->CODIGO  !=  '125'  && $datos[$i]->CODIGO  !=  '128'
                && $datos[$i]->CODIGO  !=  '154' && $datos[$i]->CODIGO  !=  '156'
                && $datos[$i]->CODIGO  !=  '126' && $datos[$i]->CODIGO  !=  '189'
            ) {
                $paso =  $paso + 1;
                $this->insertEstado($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien estado procesal";
    }

    private function insertEstado(int $id, string $descripcion)
    {
        /*
        $estado = new Estado();
        $estado->id = $id;
        $estado->descripcion = $descripcion;
        $estado->save();
        */

        DB::table('estados')->insert([
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
        $tabla->tabla = 'estados';
        $tabla->codigo = $id;
        $tabla->descripcion = $descripcion;
        $tabla->save();
        */

        DB::table('tablas')->insert([
            'tabla' =>  'estados',
            'codigo' => $id,
            'descripcion' => trim($descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
