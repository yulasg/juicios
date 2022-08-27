<?php

namespace App\Http\Controllers;


use App\Models\Dato;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Tabla;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionDatoController extends Controller
{
    //
    public function Dato()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;

        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/juicios"));
        //return $datos;
        for ($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;

            switch ($datos[$i]->TIPO_TASA) {
                case "F":
                    $tasa = "F";
                    break;
                case "V":
                    $tasa = "V";
                    break;
                default:
                    $tasa = "N";
                    break;
            };
            $USUARIO =  trim($datos[$i]->USUARIO) ;
            $this->insertDato(
                $datos[$i]->JUICIO_ID,
                $datos[$i]->IdReal,
                $datos[$i]->MONTO_CAPITAL,
                $datos[$i]->MONTO_DEMANDA,
                $tasa,
                $datos[$i]->TASA_MORA,
                $datos[$i]->TASA_INTERES,
                trim($datos[$i]->OBSERVACIONES_JUICIO),
                trim($datos[$i]->JUEZ_PONENTE),
                $USUARIO 
            );
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
        return "salio todo bien dato";
    }

    private function insertDato(
        $JUICIO_ID,
        $IdReal,
        $MONTO_CAPITAL,
        $MONTO_DEMANDA,
        $tasa,
        $TASA_MORA,
        $TASA_INTERES,
        $OBSERVACIONES_JUICIO,
        $JUEZ_PONENTE,
        $USUARIO
    ) {
        /*
        $dato = new Dato();
        $dato->juicio_id = $JUICIO_ID;
        $dato->juicio_ente_id = $IdReal;
        $dato->capital = $MONTO_CAPITAL;
        $dato->monto = $MONTO_DEMANDA;
        $dato->tasa = $tasa;
        $dato->mora = $TASA_MORA;
        $dato->interes = $TASA_INTERES;
        $dato->observacion = $OBSERVACIONES_JUICIO;
        $dato->juez = $JUEZ_PONENTE;
        $dato->save();
        */
        DB::table('datos')->insert([
            'juicio_id' => $JUICIO_ID,
            'juicio_ente_id' => $IdReal,
            'capital' => $MONTO_CAPITAL,
            'monto' => $MONTO_DEMANDA,
            'tasa' => $tasa,
            'mora' => $TASA_MORA,
            'interes' => $TASA_INTERES,
            'observacion' => trim($OBSERVACIONES_JUICIO) ,
            'juez' => trim($JUEZ_PONENTE),
            'usuario' => $USUARIO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
