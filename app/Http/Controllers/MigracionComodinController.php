<?php

namespace App\Http\Controllers;

use App\Models\Comodin;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Tabla;

class MigracionComodinController extends Controller
{
    //
    public function Comodin()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;

        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/juicios"));
        //return $datos;
        for ($i = 0; $i < count($datos); ++$i) {

            
            $cod = $datos[$i]->JUICIO_ID;

            $searchString = " ";
            $replaceString = "";
            $comod1 = $datos[$i]->COMODIN1;
            $comodin1 = str_replace($searchString, $replaceString, $comod1);
            $comod2 = $datos[$i]->COMODIN2;
            $comodin2 = str_replace($searchString, $replaceString, $comod2);
            $comod3 = $datos[$i]->COMODIN3;
            $comodin3 = str_replace($searchString, $replaceString, $comod3);
            $comod4 = $datos[$i]->COMODIN4;
            $comodin4 = str_replace($searchString, $replaceString, $comod4);
            $comod5 = $datos[$i]->COMODIN5;
            $comodin5 = str_replace($searchString, $replaceString, $comod5);
            $comod6 = $datos[$i]->COMODIN6;
            $comodin6 = str_replace($searchString, $replaceString, $comod6);
            $comod7 = $datos[$i]->COMODIN7;
            $comodin7 = str_replace($searchString, $replaceString, $comod7);
            $comod8 = $datos[$i]->COMODIN8;
            $comodin8 = str_replace($searchString, $replaceString, $comod8);

            $comodin1 = strlen($comodin1);
            $comodin2 = strlen($comodin2);
            $comodin3 = strlen($comodin3);
            $comodin4 = strlen($comodin4);
            $comodin5 = strlen($comodin5);
            $comodin6 = strlen($comodin6);
            $comodin7 = strlen($comodin7);
            $comodin8 = strlen($comodin8);
   
  

            if (
                $comodin1 > 0 || $comodin2 > 0 ||
                $comodin3 > 0 || $comodin4 > 0 ||
                $comodin5 > 0 || $comodin6 > 0 ||
                $comodin7 > 0 || $comodin8 > 0
            ) {
                $paso =  $paso + 1;
                $this->insertComodin(
                    $datos[$i]->JUICIO_ID,
                    $datos[$i]->COMODIN1,
                    $datos[$i]->COMODIN2,
                    $datos[$i]->COMODIN3,
                    $datos[$i]->COMODIN4,
                    $datos[$i]->COMODIN5,
                    $datos[$i]->COMODIN6,
                    $datos[$i]->COMODIN7,
                    $datos[$i]->COMODIN8
                );
            } else {
                $noPaso =  $noPaso + 1;
                /*
                $descrp = '';
                $descrp = 'COMODIN1: ' . $datos[$i]->COMODIN1;
                $descrp =  $descrp + ' COMODIN2: ' . $datos[$i]->COMODIN2;
                $descrp =  $descrp + ' COMODIN3: ' . $datos[$i]->COMODIN3;
                $descrp =  $descrp + ' COMODIN4: ' . $datos[$i]->COMODIN4;
                $descrp =  $descrp + ' COMODIN5: ' . $datos[$i]->COMODIN5;
                $descrp =  $descrp + ' COMODIN6: ' . $datos[$i]->COMODIN6;
                $descrp =  $descrp + ' COMODIN7: ' . $datos[$i]->COMODIN7;
                $descrp =  $descrp + ' COMODIN8: ' . $datos[$i]->COMODIN8;
                */
                $this->insertTabla($datos[$i]->JUICIO_ID);
                
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
        return "salio todo bien comodines";
    }

    private function insertComodin(
        $JUICIO_ID,
        $comodin1,
        $comodin2,
        $comodin3,
        $comodin4,
        $comodin5,
        $comodin6,
        $comodin7,
        $comodin8
    ) {
        $comodin = new Comodin();
        $comodin->juicio_id = $JUICIO_ID;
        $comodin->comodin1 = $comodin1;
        $comodin->comodin2 = $comodin2;
        $comodin->comodin3 = $comodin3;
        $comodin->comodin4 = $comodin4;
        $comodin->comodin5 = $comodin5;
        $comodin->comodin6 = $comodin6;
        $comodin->comodin7 = $comodin7;
        $comodin->comodin8 = $comodin8;
        $comodin->save();
    }

    private function insertTabla(int $cod)
    {
        $tabla = new Tabla();
        $tabla->tabla = 'juicios';
        $tabla->codigo = $cod;
        $tabla->descripcion = 'comodines';
        $tabla->save();
    }
}
