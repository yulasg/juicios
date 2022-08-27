<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class MigracionSeguimientoController extends Controller
{
    //
    public function Seguimiento()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/seguimientos"));
        
        // return   trim(substr($datos[30]->USUARIO, 9, 20));
      
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        
        for ($i = 0; $i < count($datos); ++$i) {

            $codx = $datos[$i]->JUICIO_ID;
            $fecha = $datos[$i]->FECHA_ACTUACION;
            $actividad = $datos[$i]->ACTIVIDAD_PROCESAL;
            $obser = trim($datos[$i]->OBSERVACION) ;
            $usu = trim($datos[$i]->USUARIO) ;
            //$usu = trim(substr($datos[$i]->USUARIO, 7, 20)); 
            //$usu = $datos[$i]->USUARIO; 

            //$reg1 = DB::table('juicios')->where('id', $codx)->select('juicios.id')->get();
            //if (count($reg1) > 0) {
                $reg2 = DB::table('actividades')->where('id', $actividad)->select('actividades.id')->get();
                if (count($reg2) > 0) {
                    $actividad =   $reg2[0]->id;
                }else{
                    if ( $actividad == '34'){
                        $actividad = '1';
                    }
                }
                /*
                $fun =  'Login No Existe';
                $valor = strlen($usu);
                if ($valor > 0){
                    $reg3 = DB::table('funcionarios')->where('login', $usu)->select('funcionarios.*')->get();
                    if (count($reg3) > 0) {
                        $fun =   $reg3[0]->nombre;
                    }
                }            
                */
                $paso =  $paso + 1;
                $this->insertSeguimiento($codx, $fecha,  $actividad, trim($obser) , trim($usu)  );
            /*
            }else{
                $noPaso =  $noPaso + 1;
                $this->insertRegistro($codx,$actividad ,  $fecha, $usu );
            }
            */
            
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
        return "salio todo bien seguimientos";
    }

    private function insertSeguimiento($codx, $fecha,  $actividad,  $obser, $usu )
    {
        DB::table('seguimientos')->insert([
            'juicio_id' => $codx,
            'fecha' => $fecha,
            'actividad_id' => $actividad,
            'seguimiento' => trim($obser) , 
            'usuario' => trim($usu),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    /*

    private function insertRegistro( $codx, $actividad ,  $fecha, $usu )
    {
  
        DB::table('registros')->insert([
            'tabla' => 'seguimientos',
            'codigo_id' => $actividad,
            'codigo_juicio' => $codx,
            'descripcion' => $fecha.' - '. $usu,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);

    }
    */
}
