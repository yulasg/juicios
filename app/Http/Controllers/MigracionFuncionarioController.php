<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Http;

class MigracionFuncionarioController extends Controller
{
    //
    public function Funcionario()
    {
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        //$datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/funcionarios"));
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/egresados"));
        //return $datos ;
        for ($i = 0; $i < count($datos); ++$i) {
            $ced="N/A";
            $log="N/A";
            $apell="N/A";
            $nom="N/A";
         
            //$nac="Q";
            $nac="X";

            $valor1  = strlen($datos[$i]->CEDULA_P);
            //$valor2 = strlen($datos[$i]->NACIONALIDAD);
            $valor3 = strlen($datos[$i]->LOGIN);
            $valor4 = strlen($datos[$i]->APELL_P);
            $valor5 = strlen($datos[$i]->NOMBRE_P);
            if ($valor1 > 0) {$ced=$datos[$i]->CEDULA_P;}
            //if ($valor2 > 0) {$nac=$datos[$i]->NACIONALIDAD;}
            if ($valor3 > 0) {$log=$datos[$i]->LOGIN;}
            if ($valor4 > 0) {$apell=$datos[$i]->APELL_P;}
            if ($valor5 > 0) {$nom=$datos[$i]->NOMBRE_P;}
            $paso =  $paso + 1;
            $this->insertFuncionario( $ced,$nac,$log,$apell,$nom );
            //$this->insertFuncionario( $ced,$nac,$log,$apell,$nom );
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
        return "salio todo bien funcionario";
    }

    private function insertFuncionario(string $ced,string $nac,string $log,string $apell,string $nom)
    {
        $funcionario = new Funcionario();
        $funcionario->nacionalidad = $nac;
        $funcionario->cedula = $ced;
        $funcionario->login = $log;
        $funcionario->nombre = $nom;
        $funcionario->apellido = $apell;
        $funcionario->save();
    }
}
