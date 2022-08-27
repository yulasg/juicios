<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juicio;
use App\Models\Medida;
use App\Models\Obligacion;
use App\Models\Interno;
use App\Models\Externo;
use App\Models\Pretension;
use App\Models\Garantia;
use App\Models\Estado;
use App\Models\Tribunal;
use App\Models\Juzgado;
use App\Models\Procedencia;
use App\Models\Proceso;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
 
class DatatableController extends Controller
{
    //
    public function juicio()
    {
  

        $juicios = DB::table('juicios')->join('tribunales', 'tribunales.id', "=", 'juicios.tribunal_id')
        ->join('juzgados', 'juzgados.id', "=", 'tribunales.juzgado_id')
        ->join('garantias', 'garantias.id', "=", 'juicios.garantia_id')
        ->join('medidas', 'medidas.id', "=", 'juicios.medida_id')
        ->join('pretensiones', 'pretensiones.id', "=", 'juicios.pretension_id')
        ->join('obligaciones', 'obligaciones.id', "=", 'juicios.obligacion_id')
        ->join('internos', 'internos.id', "=", 'juicios.interno_id')
        ->join('externos', 'externos.id', "=", 'juicios.externo_id')
        ->join('estados', 'estados.id', "=", 'juicios.estado_id')
        ->join('demandas', 'demandas.id', "=", 'juicios.demanda_id')
        ->join('procedencias', 'procedencias.id', "=", 'juicios.procedencia_id')
        ->join('ubicaciones', 'ubicaciones.id', "=", 'juicios.ubicacion_id')
        ->join('estatus', 'estatus.id', "=", 'juicios.estatu_id')
        ->leftJoin('datos', 'datos.juicio_id', "=", 'juicios.id')
        ->select(
            "juicios.id as id",
            DB::raw("(CASE WHEN internacional = 'I' THEN 'Internacional' ELSE 'Nacional' END) AS internacional"),
            DB::raw("(CASE  origen  WHEN 'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS origen"), 
            "procedencias.descripcion as procedencia",
            "juicios.expediente as expediente",
            "ubicaciones.descripcion as ubicacion",
            DB::raw("(CASE WHEN terminado = 'S' THEN 'SI' ELSE 'NO' END) AS terminado"),
            "estatus.descripcion as estatu",
            "tribunales.descripcion as tribunal",
            "juzgados.descripcion as juzgado",
            "internos.nombre as interno",
            "externos.nombre as externo",
            "obligaciones.descripcion as obligacion",
            "estados.descripcion as estado",
            "demandas.descripcion as demanda",
            "pretensiones.descripcion as pretension",
            "garantias.descripcion as garantia",
            DB::raw("(CASE WHEN llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS llevado"),
            "medidas.descripcion as medida",
            DB::raw("(CASE WHEN practicada = 'S' THEN 'SI' ELSE 'NO' END) AS practicada"),
            DB::raw("(CASE WHEN moneda = 'BS' THEN 'Bolívares' ELSE 'Dólares' END) AS moneda"),
  
        )->get();
        return $juicios ;
        return datatables()->of($juicios)
            ->addColumn('botones', 'juicios.botones')
            ->rawColumns(['botones'])
            ->toJson();
    }
}
