<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class MigracionPagareController extends Controller
{
    //
    public function Pagare()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/documentos"));
        //return $datos;
        for ($i = 0; $i < count($datos); ++$i) {
           
            $cod = $datos[$i]->CodigoID;
            $codJuicio = $datos[$i]->JUICIO_ID;
            $NUMERO = $datos[$i]->NUMERO_DOCUMENTO;
            $fec1 = $datos[$i]->FECHA_EMISION;
            $fec2 = $datos[$i]->FECHA_VENCIMIENTO;
            $fecha= '1900-01-01 00:00:00';
            $USUARIO = trim($datos[$i]->USUARIO) ;

            $regJuicio  = DB::table('juicios')->where('id', $codJuicio)->select('juicios.*')->get();
            if (count($regJuicio) > 0) {
                if ($NUMERO =='0000' && $fec1 == $fecha && $fec2 == $fecha ){
                    $this->insertRegistro($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2   );
                    $noPaso =  $noPaso + 1;
                }else{
                    if($NUMERO =='' && $fec1 == $fecha && $fec2 == $fecha ){
                        $this->insertRegistro($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2   );
                        $noPaso =  $noPaso + 1;
                    }else{
                        if ($NUMERO =='*' && $fec1 == $fecha && $fec2 == $fecha){
                            $this->insertRegistro($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2   );
                            $noPaso =  $noPaso + 1;
                        }else{
                            $this->insertPagare($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2 , $USUARIO  );
                            $paso =  $paso + 1;
                        }
                    }
                }
            } else {
                $this->insertRegistro($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2   );
                $noPaso =  $noPaso + 1;
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
        return "salio todo bien pagares";
    }


    private function insertPagare($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2 ,$USUARIO )
    {
        DB::table('documentos')->insert([
            'id' => $cod,
            'juicio_id' => $codJuicio,
            'numero' => $NUMERO,
            'inicio' => $fec1,
            'fin' => $fec2,
            'usuario' => $USUARIO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertRegistro($cod,  $codJuicio,  $NUMERO, $fec1 , $fec2)
    {
    
        DB::table('registros')->insert([
            'tabla' => 'documentos',
            'codigo_id' => $cod,
            'codigo_juicio' => $codJuicio,
            'descripcion' => $NUMERO.' - '.$fec1.' - '.$fec2,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
