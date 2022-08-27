<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MigracionAbogadoController extends Controller
{
    //
    public function Abogado()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/asignaciones"));
        //return  $datos;
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        for ($i = 0; $i < count($datos); ++$i) {

            $cod1 = $datos[$i]->JUICIO_ID;
            $cod2 =  $datos[$i]->FUNCIONARIO_ASIGNADO;
            $usu = trim($datos[$i]->USUARIO) ;
            $fecha = $datos[$i]->FECHA;
           ;

            switch ( $cod2) {
                    // EN JUICIO TODO LO QUE TENGA CODIGO 36 SE CAMBIO POR 34
                    // EN JUICIO TODO LO QUE TENGA CODIGO 39 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 53 SE CAMBIO POR 52
                    // EN JUICIO TODO LO QUE TENGA CODIGO 60 SE CAMBIO POR 14
                    // EN JUICIO TODO LO QUE TENGA CODIGO 70 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 77 SE CAMBIO POR 76
                    // EN JUICIO TODO LO QUE TENGA CODIGO 109 SE CAMBIO POR 108
                case 36:
                    $valorInterno = true;
                    $interno = 34;
                    $internoOld = 36;
                    break;
                case 39:
                    $valorInterno = true;
                    $interno = 1;
                    $internoOld = 39;
                    break;
                case 53:
                    $valorInterno = true;
                    $interno = 52;
                    $internoOld = 53;
                    break;
                case 60:
                    $valorInterno = true;
                    $interno = 14;
                    $internoOld = 60;
                    break;
                case 70:
                    $valorInterno = true;
                    $interno = 1;
                    $internoOld = 70;
                    break;
                case 77:
                    $valorInterno = true;
                    $interno = 76;
                    $internoOld = 77;
                    break;
                case 109:
                    $valorInterno = true;
                    $interno = 108;
                    $internoOld = 109;
                    break;
                default:
                    $codInter = $datos[$i]->FUNCIONARIO_ASIGNADO;
                    $inter  = DB::table('internos')->where('id', $codInter)->select('internos.*')->get();
                    if (count($inter) > 0) {
                        $interno =  $inter[0]->id;
                    }
                    break;
            };

   


            $reg1 = DB::table('juicios')->where('id', $cod1)->select('juicios.id')->get();
            if (count($reg1) > 0) {
                $paso =  $paso + 1;
                $this->insertAbogado($cod1,  $interno,  trim($usu) , $fecha);
            } else {
                $noPaso =  $noPaso + 1;
                $this->insertRegistro($cod1,  $interno, trim($usu) , $fecha);
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
        return "salio todo bien abogados";
    }

    private function insertAbogado($cod1,   $interno,  $usu, $fecha)
    {
        DB::table('abogados')->insert([
            'juicio_id' => $cod1,
            'interno_id' => $interno,
            //'jefe_id' => $interno,
            'usuario' => trim($usu)  ,
            'fecha' => $fecha,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertRegistro($cod1, $interno,  $usu, $fecha)
    {
    
        DB::table('registros')->insert([
            'tabla' => 'abogados',
            'codigo_id' => $interno,
            'codigo_juicio' => $cod1,
            'descripcion' => $fecha.' - '.trim($usu),
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
