<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class MigracionMovimientoController extends Controller
{
    //
    public function Movimiento()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/actividades"));
        //return  $datos;
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        for ($i = 0; $i < count($datos); ++$i) {

            $cod1 = $datos[$i]->ACTIVIDAD_ID;
            $cod2 = $datos[$i]->JUICIO_ID;
            $obser = trim($datos[$i]->OBSERVACIONES) ;
            $usu = trim($datos[$i]->USUARIO) ;
            $fecha = $datos[$i]->FECHA;
         

            $reg1 = DB::table('juicios')->where('id', $cod2)->select('juicios.id')->get();
            if (count($reg1) > 0) {
                $paso =  $paso + 1;
                $this->insertMovimiento($cod1, $cod2, trim($usu) , $fecha, trim($obser)  );
            }else{
                $noPaso =  $noPaso + 1;
                $this->insertRegistro($cod1,$cod2 , trim($usu) , $fecha );
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
        return "salio todo bien movimientos";
    }

    private function insertMovimiento($cod1, $cod2,  $usu, $fecha, $obser )
    {
        DB::table('movimientos')->insert([
            'id' => $cod1,
            'juicio_id' => $cod2,
            'fecha' => $fecha,
            'movimiento' => trim($obser) ,
            'usuario' => trim($usu),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertRegistro( $cod1,$cod2 , $usu , $fecha  )
    {
  
        DB::table('registros')->insert([
            'tabla' => 'movimientos',
            'codigo_id' => $cod1,
            'codigo_juicio' => $cod2,
            'descripcion' => $fecha.' - '. trim($usu),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);

    }
}
