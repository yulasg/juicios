<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MigracionRelacionController extends Controller
{
    //
    public function Relacion()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/juicios_relacionados"));
        //return  $datos;
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $var1 = false;
        $var2 = false;
        for ($i = 0; $i < count($datos); ++$i) {
            $codx = $datos[$i]->CodigoID;
            $cod1 = $datos[$i]->JUICIO_ID_1;
            $cod2 = $datos[$i]->JUICIO_ID_2;
            $USUARIO =  trim($datos[$i]->USUARIO) ;

            $reg1 = DB::table('juicios')->where('id', $cod1)->select('juicios.id')->get();
            if (count($reg1) > 0) {
                $var1 = true;
            }

            $reg2 = DB::table('juicios')->where('id', $cod2)->select('juicios.id')->get();
            if (count($reg2) > 0) {
                $var2 = true;
            }

            if ($var1 = true && $var2 = true) {
                $paso =  $paso + 1;
                $this->insertRelacion($codx, $cod1,  $cod2,  $USUARIO  );
            } else {
                $noPaso =  $noPaso + 1;
                $this->insertRegistro($codx, $cod1,  $cod2 );
            }
            $var1 = false;
            $var2 = false;
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
        return "salio todo bien relación";
    }

    private function insertRelacion(int $codx, int $cod1, int $cod2, $USUARIO )
    {
        DB::table('relaciones')->insert([
            'id' => $codx,
            'juicio_id' => $cod1,
            'juicio1_id' => $cod2,
            'usuario' => $USUARIO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertRegistro( $codx,  $cod1, $cod2 )
    {
  
        DB::table('registros')->insert([
            'tabla' => 'relaciones',
            'codigo_id' => $codx,
            'codigo_juicio' => $cod1,
            'descripcion' => $cod2,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);

    }
}
