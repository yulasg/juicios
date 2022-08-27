<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedencia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionProcedenciaController extends Controller
{
    //
    public function Procedencia()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/procedencias_juicios"));
        for ($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;
            $this->insertProcedencia($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien procedencia";
    }

    private function insertProcedencia(string $id, string $descripcion)
    {
        /*
        $procedencia = new Procedencia();
        $procedencia->codigo = $id;
        $procedencia->descripcion = $descripcion;
        $procedencia->save();
        */

        DB::table('procedencias')->insert([
            'codigo' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
