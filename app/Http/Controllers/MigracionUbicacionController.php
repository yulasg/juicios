<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MigracionUbicacionController extends Controller
{
    //
    public function Ubicacion()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/estados"));
        for ($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;
            $this->insertUbicacion($datos[$i]->CODIGO,trim($datos[$i]->DESCRIPCION) );
      
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
        return "salio todo bien ubicación";
    }

    private function insertUbicacion(string $id, string $descripcion)
    {
        /*
        $ubicacion = new Ubicacion();
        $ubicacion->codigo = $id;
        $ubicacion->descripcion = $descripcion;
        $ubicacion->save();
        */


        DB::table('ubicaciones')->insert([
            'codigo' => $id,
            'descripcion' => trim($descripcion),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')), 
        ]);
    }
}
