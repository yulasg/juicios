<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medida;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionMedidaController extends Controller
{
    //
    public function Medida()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tipo_medidas"));

        //$datos = Http::get('https://catatumbo.fogade.gob.ve/tipo_medidas');
        //$datos = $datos->json();

        //return  $datos[0]->CODIGO ;

        //$usu = substr($datos[35]->USUARIO, 7, 20 ) ; 
        //return   $usu;
        //return   $datos;
        for ($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;
            $this->insertMedida($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien medida";
    }

    private function insertMedida(string $id, string $descripcion)
    {
        /*
        $medida = new Medida();
        $medida->id = $id;
        $medida->descripcion = $descripcion;
        $medida->save();
        */

        DB::table('medidas')->insert([
            'id' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
