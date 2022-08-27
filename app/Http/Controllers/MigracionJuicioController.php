<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Juicio;
use App\Models\Reemplazo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MigracionJuicioController extends Controller
{
    //
    public function Juicio()
    {
        $valorDemanda = false;
        $valorObligacion = false;
        $valorPretension = false;
        $valorProcesal = false;
        $valorInterno = false;
        $valorExterno = false;
        $valorTribunal = false;
        $paso = 0;
        $noPaso = 0;
        $total = 0;
        $datos = json_decode(Http::get("https://catatumbo.fogade.gob.ve/juicios"));
        //return  count($datos);

        for ($i = 0; $i < count($datos); ++$i) {
            $paso =  $paso + 1;

            // TRIBUNAL 308 CAMBIAR EN JUICIO 307
            // TRIBUNAL 337 CAMBIAR EN JUICIO 336
            // TRIBUNAL 469 CAMBIAR EN JUICIO 467
            // TRIBUNAL 473 CAMBIAR EN JUICIO 472
            // TRIBUNAL 494 CAMBIAR EN JUICIO 492
            switch ($datos[$i]->JUZGADO_TRIBUNAL) {
                case 611:
                    $valorTribunal = true;
                    $tribunal = 1;
                    $tribunalOld = 611;
                    break;
                case 308:
                    $valorTribunal = true;
                    $tribunal = 307;
                    $tribunalOld = 308;
                    break;
                case 337:
                    $valorTribunal = true;
                    $tribunal = 336;
                    $tribunalOld = 337;
                    break;
                case 469:
                    $valorTribunal = true;
                    $tribunal = 467;
                    $tribunalOld = 469;
                    break;
                case 473:
                    $valorTribunal = true;
                    $tribunal = 472;
                    $tribunalOld = 473;
                    break;
                case 494:
                    $valorTribunal = true;
                    $tribunal = 492;
                    $tribunalOld = 494;
                    break;
                case 365:
                    $valorTribunal = true;
                    $tribunal = 238;
                    $tribunalOld = 365;
                    break;
                default:
                    $tribunal = $datos[$i]->JUZGADO_TRIBUNAL;
                    break;
            };

            switch ($datos[$i]->INTERNACIONAL) {
                case 1:
                    $internacional = "I";
                    $especialidad = "2";
                    break;
                default:
                    $internacional = "N";
                    $especialidad = "1";
                    break;
            };

            switch ($datos[$i]->LLEVADO_POR) {
                case "CJ":
                    $llevado = "CJ";
                    break;
                case "AE":
                    $llevado = "AE";
                    break;
                default:
                    $llevado = "NA";
                    break;
            };

            $valor = strlen($datos[$i]->NUMERO_EXPEDIENTE);
            $expediente = 'Sin Valor Sistema Anterior';
             if ($valor > 0){
                $expediente = $datos[$i]->NUMERO_EXPEDIENTE;
            };

            switch ($datos[$i]->TIPO_DEMANDA) {
                case 78:
                    $valorDemanda = true;
                    $demanda = 2;
                    $demandaOld = 78;
                    break;
                case 40:
                    $valorDemanda = true;
                    $demanda = 38;
                    $demandaOld = 40;
                    break;
                default:
                    $demanda = $datos[$i]->TIPO_DEMANDA;
                    break;
            };
            $cod = $datos[$i]->PROCEDENCIA;
            $proce  = DB::table('procedencias')->where('codigo', $cod)->select('procedencias.*')->get();
            if (count($proce) > 0) {
                $procedencia =  $proce[0]->id;
            }

            $codEsta = $datos[$i]->ESTADO;
            $esta  = DB::table('ubicaciones')->where('codigo', $codEsta)->select('ubicaciones.*')->get();
            if (count($esta) > 0) {
                $estado =  $esta[0]->id;
            }

            switch ($datos[$i]->TIPO_OBLIGACION) {
                case 52:
                    $valorObligacion = true;
                    $obligacion = 49;
                    $obligacionOld = 52;
                    break;
                case 57:
                    $valorObligacion = true;
                    $obligacion = 1;
                    $obligacionOld = 57;
                    break;
                default:
                    $codObli = $datos[$i]->TIPO_OBLIGACION;
                    $obli  = DB::table('obligaciones')->where('id', $codObli)->select('obligaciones.*')->get();
                    if (count($obli) > 0) {
                        $obligacion =  $obli[0]->id;
                    }
                    break;
            };

            switch ($datos[$i]->TIPO_PRETENSION) {
                case 53:
                    $valorPretension = true;
                    $pretension = 47;
                    $pretensionOld = 53;
                    break;
                case 49:
                    $valorPretension = true;
                    $pretension = 1;
                    $pretensionOld = 49;
                    break;
                default:
                    $codPrete = $datos[$i]->TIPO_PRETENSION;
                    $prete  = DB::table('pretensiones')->where('id', $codPrete)->select('pretensiones.*')->get();
                    if (count($prete) > 0) {
                        $pretension =  $prete[0]->id;
                    }
                    break;
            };

            switch ($datos[$i]->ESTADO_PROCESAL) {
                    // EN JUICIO TODO LO QUE TENGA CODIGO 122 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 124 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 125 SE CAMBIO POR 123
                    // EN JUICIO TODO LO QUE TENGA CODIGO 126 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 128 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 154 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 156 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 189 SE CAMBIO POR 188
                case 122:
                    $valorProcesal = true;
                    $procesal = 1;
                    $procesalOld = 122;
                    break;
                case 124:
                    $valorProcesal = true;
                    $procesal = 1;
                    $procesalOld = 124;
                    break;
                case 126:
                    $valorProcesal = true;
                    $procesal = 1;
                    $procesalOld = 126;
                    break;
                case 128:
                    $valorProcesal = true;
                    $procesal = 1;
                    $procesalOld = 128;
                    break;
                case 154:
                    $valorProcesal = true;
                    $procesal = 1;
                    $procesalOld = 154;
                    break;
                case 156:
                    $valorProcesal = true;
                    $esprocesaltado = 1;
                    $procesalOld = 156;
                    break;
                case 125:
                    $valorProcesal = true;
                    $procesal = 123;
                    $procesalOld = 125;
                    break;
                case 189:
                    $valorProcesal = true;
                    $procesal = 188;
                    $procesalOld = 189;
                    break;
                default:
                    $codProcesal = $datos[$i]->ESTADO_PROCESAL;
                    $procesa  = DB::table('estados')->where('id', $codProcesal)->select('estados.*')->get();
                    if (count($procesa) > 0) {
                        $procesal =  $procesa[0]->id;
                    }
                    break;
            };

            $admision = $datos[$i]->FECHA_ADMISION_DEMANDA;

            $asignacion = $datos[$i]->FECHA_ASIGNACION;
            switch ($datos[$i]->MONEDA) {
                case "BS":
                    $moneda = "BS";
                    break;
                case "US":
                    $moneda = "US";
                    break;
                default:
                    $moneda = "NA";
                    break;
            };

            switch ($datos[$i]->ESTATUS) {
                case "SIN EJECUTAR":
                    $estatus = 1;
                    break;
                case "EN PROCESO":
                    $estatus = 2;
                    break;
                case "EXTRA JUDICIAL":
                    $estatus = 3;
                    break;
                case "GANADO":
                    $estatus = 4;
                    break;
                case "PARCIALMENTE GANADO":
                    $estatus = 5;
                    break;
                case "PERDIDO":
                    $estatus = 6;
                    break;
                case "DEVUELTO A SUDEBAN":
                    $estatus = 7;
                    break;
                case "DESISTIDO":
                    $estatus = 8;
                    break;
                case "PERIMIDO":
                    $estatus = 9;
                    break;
                case "MISERABLES< 20000Bs":
                    $estatus = 10;
                    break;
                case "SELECCIONADOS 1":
                    $estatus = 11;
                    break;
                case "SELECCIONADOS 2":
                    $estatus = 12;
                    break;
                case "SELECCIONADOS 3":
                    $estatus = 13;
                    break;
                case "DEVUELTO A CREDITOS":
                    $estatus = 14;
                    break;
                case "MANDAMIENTO DE EJECUCIÓN":
                    $estatus = 15;
                    break;
                case "SIN INFORMACIÓN":
                    $estatus = 16;
                    break;
                default:
                    $estatus = 17;
                    break;
            };

            switch ($datos[$i]->ABOGADO_INTERNO) {
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
                    $codInter = $datos[$i]->ABOGADO_INTERNO;
                    $inter  = DB::table('internos')->where('id', $codInter)->select('internos.*')->get();
                    if (count($inter) > 0) {
                        $interno =  $inter[0]->id;
                    }
                    break;
            };

            switch ($datos[$i]->ABOGADO_EXTERNO) {
                    // EN JUICIO TODO LO QUE TENGA CODIGO 326 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 382 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 397 SE CAMBIO POR 396
                    // EN JUICIO TODO LO QUE TENGA CODIGO 413 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 415 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 436 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 437 SE CAMBIO POR 435
                    // EN JUICIO TODO LO QUE TENGA CODIGO 439 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 451 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 462 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 463 SE CAMBIO POR 1
                    // EN JUICIO TODO LO QUE TENGA CODIGO 468 SE CAMBIO POR 1
                case 326:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 326;
                    break;
                case 382:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 382;
                    break;
                case 397:
                    $valorExterno = true;
                    $externo = 396;
                    $externoOld = 397;
                    break;
                case 413:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 413;
                    break;
                case 415:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 415;
                    break;
                case 436:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 436;
                    break;
                case 437:
                    $valorExterno = true;
                    $externo = 435;
                    $externoOld = 437;
                    break;
                case 439:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 439;
                    break;
                case 451:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 451;
                    break;
                case 462:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 462;
                    break;
                case 463:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 463;
                    break;
                case 468:
                    $valorExterno = true;
                    $externo = 1;
                    $externoOld = 468;
                    break;
                default:
                    $codExter = $datos[$i]->ABOGADO_EXTERNO;
                    $exter  = DB::table('externos')->where('id', $codExter)->select('externos.*')->get();
                    if (count($exter) > 0) {
                        $externo =  $exter[0]->id;
                    }
                    break;
            };

            $actuacion = $datos[$i]->FECHA_ULTIMA_ACTUACION;
            $movimiento =  $datos[$i]->FECHA_ULTIMA_ACTIVIDAD;
            $creacion =   $datos[$i]->FECHA_REGISTRO_DEMANDA;
            $USUARIO = trim($datos[$i]->USUARIO);

            $this->insertJuicio(
                $datos[$i]->JUICIO_ID,
                $datos[$i]->ORIGEN_JUICIO,
                $internacional,
                $datos[$i]->TIPO_GARANTIA,
                $llevado,
                $expediente,
                $datos[$i]->TIPO_MEDIDA,
                $datos[$i]->MEDIDA_PRACTICADA,
                $especialidad,
                $demanda,
                $procedencia,
                $estado,
                $obligacion,
                $pretension,
                $procesal,
                $admision,
                $asignacion,
                $moneda,
                $estatus,
                $interno,
                $externo,
                $actuacion,
                $movimiento,
                $creacion,
                $tribunal,
                $USUARIO
            );

            if ($valorDemanda == true) {
                $this->insertReemplazoDemanda(
                    $datos[$i]->JUICIO_ID,
                    $demandaOld,
                    $demanda,
                );
                $valorDemanda = false;
            };

            if ($valorObligacion == true) {
                $this->insertReemplazoObligacion(
                    $datos[$i]->JUICIO_ID,
                    $obligacionOld,
                    $obligacion,
                );
                $valorObligacion = false;
            };

            if ($valorPretension == true) {
                $this->insertReemplazoPretension(
                    $datos[$i]->JUICIO_ID,
                    $pretensionOld,
                    $pretension,
                );
                $valorPretension = false;
            };

            if ($valorProcesal == true) {
                $this->insertReemplazoProcesal(
                    $datos[$i]->JUICIO_ID,
                    $procesalOld,
                    $procesal,
                );
                $valorProcesal = false;
            };

            if ($valorInterno == true) {
                $this->insertReemplazoInterno(
                    $datos[$i]->JUICIO_ID,
                    $internoOld,
                    $interno,
                );
                $valorInterno = false;
            };

            if ($valorExterno == true) {
                $this->insertReemplazoExterno(
                    $datos[$i]->JUICIO_ID,
                    $externoOld,
                    $externo,
                );
                $valorExterno = false;
            };

            if ($valorTribunal == true) {
                $this->insertReemplazoTribunal(
                    $datos[$i]->JUICIO_ID,
                    $tribunalOld,
                    $tribunal,
                );
                $valorTribunal = false;
            };
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
        return "salio todo bien juicio";
    }

    private function insertJuicio(
        int $JUICIO_ID,
        string $ORIGEN_JUICIO,
        string $internacional,
        int $TIPO_GARANTIA,
        string $llevado,
        string $expediente,
        int $TIPO_MEDIDA,
        string $MEDIDA_PRACTICADA,
        string $especialidad,
        int $demanda,
        int $procedencia,
        int $estado,
        int $obligacion,
        int $pretension,
        int $procesal,
        $admision,
        $asignacion,
        string  $moneda,
        int $estatus,
        int $interno,
        int $externo,
        $actuacion,
        $movimiento,
        $creacion,
        int $tribunal,
        $USUARIO

    ) {
        /*
        $juicio = new Juicio();
        $juicio->id = $JUICIO_ID;
        $juicio->origen = $ORIGEN_JUICIO;
        $juicio->internacional = $internacional;
        $juicio->garantia_id = $TIPO_GARANTIA;
        $juicio->llevado = $llevado;
        $juicio->expediente = $expediente;
        $juicio->medida_id = $TIPO_MEDIDA;
        $juicio->practicada = $MEDIDA_PRACTICADA;
        $juicio->especialidad_id = $especialidad;
        $juicio->demanda_id = $demanda;
        $juicio->procedencia_id = $procedencia;
        $juicio->ubicacion_id = $estado;
        $juicio->obligacion_id = $obligacion;
        $juicio->pretension_id = $pretension;
        $juicio->estado_id = $procesal;
        $juicio->admision = $admision;
        $juicio->asignacion = $asignacion;
        $juicio->moneda = $moneda;
        $juicio->estatu_id = $estatus;
        $juicio->interno_id = $interno;
        $juicio->externo_id = $externo;
        $juicio->actuacion = $actuacion;
        $juicio->movimiento = $movimiento;
        $juicio->creacion = $creacion;
        $juicio->tribunal_id = $tribunal;
        $juicio->save();
        */

        DB::table('juicios')->insert([
            'id' => $JUICIO_ID,
            'origen' => $ORIGEN_JUICIO,
            'internacional' => $internacional,
            'garantia_id' => $TIPO_GARANTIA,
            'llevado' => $llevado,
            'expediente' => $expediente,
            'medida_id' => $TIPO_MEDIDA,
            'practicada' => $MEDIDA_PRACTICADA,
            'especialidad_id' => $especialidad,
            'demanda_id' => $demanda,
            'procedencia_id' => $procedencia,
            'ubicacion_id' => $estado,
            'obligacion_id' => $obligacion,
            'pretension_id' => $pretension,
            'estado_id' => $procesal,
            'admision' => $admision,
            'asignacion' => $asignacion,
            'moneda' => $moneda,
            'estatu_id' => $estatus,
            'interno_id' => $interno,
            'externo_id' => $externo,
            'actuacion' => $actuacion,
            'movimiento' => $movimiento,
            'creacion' => $creacion,
            'tribunal_id' => $tribunal,
            'usuario' => $USUARIO,
            'representante' => 'N',
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
            //"created_at" => Carbon::now(), # new \Datetime()
            //"updated_at" => Carbon::now(),  # new \Datetime()
        ]);
    }

    private function insertReemplazoDemanda(
        string $JUICIO_ID,
        string $demanda,
        string $demandaOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $demandaOld;
        $reemplazo->campoAnterior = $demanda;
        $reemplazo->descripcion = "demanda_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $demandaOld,
            'campoAnterior' => $demanda,
            'descripcion' => "demanda_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoObligacion(
        string $JUICIO_ID,
        string $obligacion,
        string $obligacionOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $obligacionOld;
        $reemplazo->campoAnterior = $obligacion;
        $reemplazo->descripcion = "obligacion_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $obligacionOld,
            'campoAnterior' => $obligacion,
            'descripcion' => "obligacion_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoPretension(
        string $JUICIO_ID,
        string $pretension,
        string $pretensionOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $pretensionOld;
        $reemplazo->campoAnterior = $pretension;
        $reemplazo->descripcion = "pretension_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $pretensionOld,
            'campoAnterior' => $pretension,
            'descripcion' => "pretension_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoProcesal(
        string $JUICIO_ID,
        string $procesal,
        string $procesalOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $procesalOld;
        $reemplazo->campoAnterior = $procesal;
        $reemplazo->descripcion = "estado_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $procesalOld,
            'campoAnterior' => $procesal,
            'descripcion' => "estado_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoInterno(
        string $JUICIO_ID,
        string $interno,
        string $internoOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $internoOld;
        $reemplazo->campoAnterior = $interno;
        $reemplazo->descripcion = "interno_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $internoOld,
            'campoAnterior' => $interno,
            'descripcion' => "interno_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoExterno(
        string $JUICIO_ID,
        string $externo,
        string $externoOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $externoOld;
        $reemplazo->campoAnterior = $externo;
        $reemplazo->descripcion = "externo_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $externoOld,
            'campoAnterior' => $externo,
            'descripcion' => "externo_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }

    private function insertReemplazoTribunal(
        string $JUICIO_ID,
        string $tribunal,
        string $tribunalOld

    ) {
        /*
        $reemplazo = new Reemplazo();
        $reemplazo->codigo_juicio = $JUICIO_ID;
        $reemplazo->tabla = "juicios";
        $reemplazo->campoActual = $tribunalOld;
        $reemplazo->campoAnterior = $tribunal;
        $reemplazo->descripcion = "tribunal_id";
        $reemplazo->save();
        */

        DB::table('reemplazos')->insert([
            'codigo_juicio' =>   $JUICIO_ID,
            'tabla' => "juicios",
            'campoActual' =>  $tribunalOld,
            'campoAnterior' => $tribunal,
            'descripcion' => "tribunal_id",
            'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            'updated_at' => date("Y-m-d H:i:s", strtotime('now')),
        ]);
    }
}
