<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class MigracionAgendaController extends Controller
{
    //
    public function Agenda()
    {
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/agenda"));
        //return  $datos;
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        for ($i = 0; $i < count($datos); ++$i) {

            $cod1 = $datos[$i]->AGENDA_ID;
            $dest = trim($datos[$i]->DESTINO) ;
            $asun =  trim($datos[$i]->ASUNTO) ;
            $ref1 = trim($datos[$i]->REFERENCIA1) ;
            $ref2 =trim($datos[$i]->REFERENCIA2) ;
            $fecha = $datos[$i]->FECHA_HORA_CITA;
            $USUARIO = trim($datos[$i]->USUARIO); 
            $this->insertAgenda($cod1, trim($dest) ,trim( $asun) , $fecha, trim($ref1) ,trim($ref2 ), trim($USUARIO) );
            $paso =  $paso + 1;
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
        return "salio todo bien agendas";
    }

    private function insertAgenda($cod1, $dest,  $asun, $fecha, $ref1, $ref2, $USUARIO )
    {
        DB::table('agendas')->insert([
            'id' => $cod1,
            'inicio' => $fecha,
            'destino' =>trim( $dest),
            'asunto' => trim( $asun),
            'referencia1' => trim($ref1),
            'referencia2' => trim($ref2 ),
            'usuario' => $USUARIO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    
}
