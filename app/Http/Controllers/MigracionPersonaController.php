<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Registro;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class MigracionPersonaController extends Controller
{
    //
    public function Persona()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/demandantes_demandados"));
        //return $datos;
        for ($i = 0; $i < count($datos); ++$i) {
           
            $codJuicio = $datos[$i]->JUICIO_ID;
            $nombre = trim($datos[$i]->NOMBRE) ;
            $tipo = $datos[$i]->TIPO;
            $descripcion = 'Tipo:'.$tipo .' Nommbre: '.$nombre;
            $regJuicio  = DB::table('juicios')->where('id', $codJuicio)->select('juicios.*')->get();
            if (count($regJuicio) > 0) {
                switch ($regJuicio[0]->internacional) {
                    case "I":
                        if ($tipo == 'D') {
                            $tipoP = 3;
                        } else {
                            $tipoP = 4;
                        }
                        break;
                    default:
                        if ($tipo == 'D') {
                            $tipoP = 1;
                        } else {
                            $tipoP = 2;
                        }
                        break;
                };
                $USUARIO =  trim($datos[$i]->USUARIO); 
                $this->insertPersona($datos[$i]->CodigoID,$datos[$i]->JUICIO_ID, trim($nombre) , $tipoP, $USUARIO );
                $paso =  $paso + 1;
            } else {
                $noPaso =  $noPaso + 1;
                $this->insertRegistro($datos[$i]->CodigoID,$datos[$i]->JUICIO_ID, $descripcion);
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
        return "salio todo bien persona";
    }

    private function insertPersona(int $CodigoID, int $JUICIO_ID, string $nombre,  string $tipoP, $USUARIO )
    {
        /*
        $persona = new Persona();
        $persona->id = $CodigoID;
        $persona->juicio_id = $JUICIO_ID;
        $persona->nombre = $nombre;
        $persona->configuracion_id = $tipoP;
        $persona->save();
        */

        DB::table('personas')->insert([
            'id' => $CodigoID,
            'juicio_id' => $JUICIO_ID,
            'nombre' => trim($nombre),
            'configuracion_id' => $tipoP,
            'usuario' => $USUARIO,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertRegistro(int $CodigoID, int $JUICIO_ID, string $descripcion)
    {
        /*
        $registro = new Registro();
        $registro->tabla = 'personas';
        $registro->codigo_id = $CodigoID;
        $registro->codigo_juicio = $JUICIO_ID;
        $registro->descripcion = $descripcion;
        $registro->save();
        */

        DB::table('registros')->insert([
            'tabla' => 'personas',
            'codigo_id' => $CodigoID,
            'codigo_juicio' => $JUICIO_ID,
            'descripcion' => $descripcion,
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
