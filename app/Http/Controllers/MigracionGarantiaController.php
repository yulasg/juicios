<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Garantia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class MigracionGarantiaController extends Controller
{
    //
    public function Garantia(){
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/tipo_garantia"));
        for($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;
            $this->insertGarantia($datos[$i]->CODIGO, trim($datos[$i]->DESCRIPCION) );
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
        return "salio todo bien garantia";
    }

    private function insertGarantia( int $id, string $descripcion)
    {
        /*
        $obligacion = new Garantia();
        $obligacion->id = $id;
        $obligacion->descripcion = $descripcion;
        $obligacion->save();
        */

        DB::table('garantias')->insert([
            'id' => $id,
            'descripcion' => trim($descripcion) ,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
