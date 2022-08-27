<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Juicio;


use Illuminate\Support\Facades\Cache;

class JuicioRepositorio
{

    static  public function getJuiciosEspecialidades()
    {
        $demandantes = DB::table('actores as a1')
            ->join('referencias as r1', 'r1.id', "=", 'a1.referencia_id')
            ->join('configuraciones as c1', 'c1.id', "=", 'a1.configuracion_id')
            ->join('especialidades as e1', 'e1.id', "=", 'c1.especialidad_id')
            ->select(DB::raw("a1.juicio_id,  array_to_string( ARRAY_AGG(r1.nombre) , ', ')  as demandantes "))
            ->whereNull('a1.deleted_at')
            ->wherein('a1.configuracion_id', ['5', '9', '12', '15', '18', '21', '24', '27', '30', '33', '36', '39', '42', '45', '48', '51'])
            ->groupBy('a1.juicio_id');

        $demandados = DB::table('actores as a2')
            ->join('referencias as r2', 'r2.id', "=", 'a2.referencia_id')
            ->join('configuraciones as c2', 'c2.id', "=", 'a2.configuracion_id')
            ->join('especialidades as e2', 'e2.id', "=", 'c2.especialidad_id')
            ->select(DB::raw("a2.juicio_id,  array_to_string( ARRAY_AGG(r2.nombre) , ', ')  as demandados "))
            ->whereNull('a2.deleted_at')
            ->wherein('a2.configuracion_id', ['6', '8', '11', '14', '17', '20', '23', '26', '29', '32', '35', '38', '41', '44', '47', '50'])
            ->groupBy('a2.juicio_id');

        $terceros = DB::table('actores as a3')
            ->join('referencias as r3', 'r3.id', "=", 'a3.referencia_id')
            ->join('configuraciones as c3', 'c3.id', "=", 'a3.configuracion_id')
            ->join('especialidades as e3', 'e3.id', "=", 'c3.especialidad_id')
            ->select(DB::raw("a3.juicio_id,  array_to_string( ARRAY_AGG(r3.nombre) , ', ')  as terceros "))
            ->whereNull('a3.deleted_at')
            ->wherein('a3.configuracion_id', ['7', '10', '13', '16', '19', '22', '25', '28', '31', '34', '37', '40', '43', '46', '49', '52'])
            ->groupBy('a3.juicio_id');

        $juicios = DB::table('juicios as j')
            ->join('tribunales as t', 't.id', "=", 'j.tribunal_id')
            ->join('juzgados as ju', 'ju.id', "=", 't.juzgado_id')
            ->join('procedencias as p', 'p.id', "=", 'j.procedencia_id')
            ->join('ubicaciones as u', 'u.id', "=", 'j.ubicacion_id')
            ->join('especialidades as espe', 'espe.id', "=", 'j.especialidad_id')
            ->join('estatus as esta', 'esta.id', "=", 'j.estatu_id')
            ->join('internos as i', 'i.id', "=", 'j.interno_id')
            ->join('externos as exte', 'exte.id', "=", 'j.externo_id')
            ->join('obligaciones as o', 'o.id', "=", 'j.obligacion_id')
            ->join('estados as e', 'e.id', "=", 'j.estado_id')
            ->join('demandas as d', 'd.id', "=", 'j.demanda_id')
            ->join('pretensiones as pret', 'pret.id', "=", 'j.pretension_id')
            ->join('garantias as g', 'g.id', "=", 'j.garantia_id')
            ->join('medidas as m', 'm.id', "=", 'j.medida_id')
            ->leftJoin('datos as da', 'da.juicio_id', "=", 'j.id')
            ->leftJoinSub($demandantes, 'demandantes', function ($join) {
                $join->on('j.id', '=', 'demandantes.juicio_id');
            })
            ->leftJoinSub($demandados, 'demandados', function ($join) {
                $join->on('j.id', '=', 'demandados.juicio_id');
            })
            ->leftJoinSub($terceros, 'terceros', function ($join) {
                $join->on('j.id', '=', 'terceros.juicio_id');
            })
            ->select(
                'j.id as juicio_id',
                DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                'j.especialidad_id',
                'espe.descripcion as e_especialidad',
                DB::raw("(CASE j.origen WHEN  'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS j_origen"),
                'p.descripcion as procedencia',
                'u.descripcion as ubicacion',
                DB::raw("(CASE WHEN esta.terminado = 'S' THEN 'SI' ELSE 'NO' END) AS e_terminado"),
                'esta.descripcion as estatu',
                'j.expediente',
                't.descripcion as tribunal',
                'ju.descripcion as juzgado',
                'i.nombre as interno',
                'exte.nombre as externo',
                'o.descripcion as obligacion',
                'e.descripcion as estado_procesal',
                'd.descripcion as demanda',
                'pret.descripcion as pretension',
                'g.descripcion as garantia',
                DB::raw("(CASE WHEN j.llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS j_llevado"),
                'm.descripcion as medida',
                DB::raw("(CASE WHEN j.practicada = 'S' THEN 'SI' ELSE 'NO' END) AS j_practicada"),
                DB::raw("(CASE j.moneda WHEN  'BS' THEN 'Bolívares' WHEN 'NA' THEN 'Sin Valor' ELSE 'Dólares' END) AS j_moneda"),
                DB::raw("to_char( j.admision  ,'DD/MM/YYYY' ) as admision"),
                DB::raw("to_char( j.asignacion  ,'DD/MM/YYYY' ) as asignacion"),
                DB::raw("to_char( j.actuacion  ,'DD/MM/YYYY' ) as actuacion"),
                DB::raw("to_char( j.creacion  ,'DD/MM/YYYY' ) as creacion"),
                DB::raw("to_char( j.movimiento  ,'DD/MM/YYYY' ) as movimiento"),
                /*
                DB::raw(" date_format( j.admision, '%d/%m/%Y' ) as admision "),
                DB::raw(" date_format( j.asignacion, '%d/%m/%Y' ) as asignacion "),
                DB::raw(" date_format( j.actuacion, '%d/%m/%Y' ) as actuacion "),
                DB::raw(" date_format( j.creacion, '%d/%m/%Y' ) as creacion "),
                DB::raw(" date_format( j.movimiento, '%d/%m/%Y' ) as movimiento "),
                */
                'da.capital',
                'da.monto',
                DB::raw("(CASE da.tasa WHEN  'F' THEN 'Fija' WHEN 'V' THEN 'Variable' ELSE 'Sin Valor' END) AS tasa"),
                'da.mora',
                'da.interes',
                'da.observacion as observacion',
                'da.juez as juez',
                'demandantes',
                'demandados',
                'terceros',
            )
            ->whereNull('j.deleted_at')
            ->whereBetween('j.especialidad_id', ['3', '18'])
            ->orderBy('j.id', 'desc')
            ->get();
        return $juicios;
    }
    static  public function getJuiciosEspecialidadFogade()
    {


        //MySQL 
        /*
        $demandantes = DB::table('personas as p1')->whereNull('p1.deleted_at')
        ->select(DB::raw("p1.juicio_id, GROUP_CONCAT(p1.nombre) as demandantes "))
        ->where('p1.configuracion_id', '2')->orwhere('p1.configuracion_id', '4')
        ->groupBy('p1.juicio_id');
        */
        //MySQL 
        /*
        $demandados = DB::table('personas as p2')->whereNull('p2.deleted_at')
        ->select(DB::raw("p2.juicio_id, GROUP_CONCAT(p2.nombre) as demandados "))
        ->where('p2.configuracion_id', '1')->orwhere('p2.configuracion_id', '3')
        ->groupBy('p2.juicio_id');
        */


        $demandantes = DB::table('personas as p1')->whereNull('p1.deleted_at')
            ->select(DB::raw("p1.juicio_id,  array_to_string( ARRAY_AGG(p1.nombre) , ', ')  as demandantes "))
            ->wherein('p1.configuracion_id', ['2', '4'])
            ->groupBy('p1.juicio_id');


        $demandados = DB::table('personas as p2')->whereNull('p2.deleted_at')
            ->select(DB::raw("p2.juicio_id,  array_to_string( ARRAY_AGG(p2.nombre) , ', ')  as demandados "))
            ->wherein('p2.configuracion_id', ['1', '3'])
            ->groupBy('p2.juicio_id');

        $juicios = DB::table('juicios as j')
            ->join('tribunales as t', 't.id', "=", 'j.tribunal_id')
            ->join('juzgados as ju', 'ju.id', "=", 't.juzgado_id')
            ->join('procedencias as p', 'p.id', "=", 'j.procedencia_id')
            ->join('ubicaciones as u', 'u.id', "=", 'j.ubicacion_id')
            ->join('especialidades as espe', 'espe.id', "=", 'j.especialidad_id')
            ->join('estatus as esta', 'esta.id', "=", 'j.estatu_id')
            ->join('internos as i', 'i.id', "=", 'j.interno_id')
            ->join('externos as exte', 'exte.id', "=", 'j.externo_id')
            ->join('obligaciones as o', 'o.id', "=", 'j.obligacion_id')
            ->join('estados as e', 'e.id', "=", 'j.estado_id')
            ->join('demandas as d', 'd.id', "=", 'j.demanda_id')
            ->join('pretensiones as pret', 'pret.id', "=", 'j.pretension_id')
            ->join('garantias as g', 'g.id', "=", 'j.garantia_id')
            ->join('medidas as m', 'm.id', "=", 'j.medida_id')
            ->leftJoin('datos as da', 'da.juicio_id', "=", 'j.id')
            ->leftJoinSub($demandantes, 'demandantes', function ($join) {
                $join->on('j.id', '=', 'demandantes.juicio_id');
            })
            ->leftJoinSub($demandados, 'demandados', function ($join) {
                $join->on('j.id', '=', 'demandados.juicio_id');
            })
            ->select(
                'j.id as juicio_id',
                DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                'j.especialidad_id',
                'espe.descripcion as e_especialidad',
                DB::raw("(CASE j.origen WHEN  'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS j_origen"),
                'p.descripcion as procedencia',
                'u.descripcion as ubicacion',
                DB::raw("(CASE WHEN esta.terminado = 'S' THEN 'SI' ELSE 'NO' END) AS e_terminado"),
                'esta.descripcion as estatu',
                'j.expediente',
                't.descripcion as tribunal',
                'ju.descripcion as juzgado',
                'i.nombre as interno',
                'exte.nombre as externo',
                'o.descripcion as obligacion',
                'e.descripcion as estado_procesal',
                'd.descripcion as demanda',
                'pret.descripcion as pretension',
                'g.descripcion as garantia',
                DB::raw("(CASE WHEN j.llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS j_llevado"),
                'm.descripcion as medida',
                DB::raw("(CASE WHEN j.practicada = 'S' THEN 'SI' ELSE 'NO' END) AS j_practicada"),
                DB::raw("(CASE j.moneda WHEN  'BS' THEN 'Bolívares' WHEN 'NA' THEN 'Sin Valor' ELSE 'Dólares' END) AS j_moneda"),
                DB::raw("to_char( j.admision  ,'DD/MM/YYYY' ) as admision"),
                DB::raw("to_char( j.asignacion  ,'DD/MM/YYYY' ) as asignacion"),
                DB::raw("to_char( j.actuacion  ,'DD/MM/YYYY' ) as actuacion"),
                DB::raw("to_char( j.creacion  ,'DD/MM/YYYY' ) as creacion"),
                DB::raw("to_char( j.movimiento  ,'DD/MM/YYYY' ) as movimiento"),
                /*
                DB::raw(" date_format( j.admision, '%d/%m/%Y' ) as admision "),
                DB::raw(" date_format( j.asignacion, '%d/%m/%Y' ) as asignacion "),
                DB::raw(" date_format( j.actuacion, '%d/%m/%Y' ) as actuacion "),
                DB::raw(" date_format( j.creacion, '%d/%m/%Y' ) as creacion "),
                DB::raw(" date_format( j.movimiento, '%d/%m/%Y' ) as movimiento "),
                */
                'da.capital',
                'da.monto',
                DB::raw("(CASE da.tasa WHEN  'F' THEN 'Fija' WHEN 'V' THEN 'Variable' ELSE 'Sin Valor' END) AS tasa"),
                'da.mora',
                'da.interes',
                'da.observacion as observacion',
                'da.juez as juez',
                'demandantes',
                'demandados',
            )
            ->whereNull('j.deleted_at')
            ->wherein('j.especialidad_id', ['1', '2'])
            ->orderBy('j.id', 'desc')
            ->get();
        return $juicios;
    }

    static  public function getTodosJuicios()
    {
        /*
        if(request()->page){
            $key = 'juicios'.request()->page;
        }else{
            $key = 'juicios';
        }
        */

        if (Cache::has('juicios')) {
            $juicios = Cache::get('juicios');
        } else {
            $juicios = DB::table('juicios')
                ->select(
                    'juicios.id',
                    DB::raw("(CASE juicios.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                    'juicios.especialidad_id',
                    'juicios.representante',
                    'especialidades.descripcion as e_especialidad',
                    DB::raw("(CASE origen WHEN  'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS j_origen"),
                    'procedencias.descripcion as procedencia',
                    'ubicaciones.descripcion as ubicacion',
                    DB::raw("(CASE representante WHEN  'U' THEN 'Único' WHEN 'V' THEN 'Varios' ELSE 'Ninguno' END) AS j_representante"),
                    DB::raw("(CASE WHEN terminado = 'S' THEN 'SI' ELSE 'NO' END) AS e_terminado"),
                    'estatus.descripcion as estatu',
                    'juicios.expediente',
                    'tribunales.descripcion as tribunal',
                    'juzgados.descripcion as juzgado',
                    'internos.nombre as interno',
                    'externos.nombre as externo',
                    'obligaciones.descripcion as obligacion',
                    'estados.descripcion as estado_procesal',
                    'demandas.descripcion as demanda',
                    'pretensiones.descripcion as pretension',
                    'garantias.descripcion as garantia',
                    DB::raw("(CASE WHEN llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS j_llevado"),
                    'medidas.descripcion as medida',
                    DB::raw("(CASE WHEN practicada = 'S' THEN 'SI' ELSE 'NO' END) AS j_practicada"),
                    DB::raw("(CASE moneda WHEN  'BS' THEN 'Bolívares' WHEN 'NA' THEN 'Sin Valor' ELSE 'Dólares' END) AS j_moneda"),

                    DB::raw("to_char( juicios.admision  ,'DD/MM/YYYY' ) as admision"),
                    DB::raw("to_char( juicios.asignacion  ,'DD/MM/YYYY' ) as asignacion"),
                    DB::raw("to_char( juicios.actuacion  ,'DD/MM/YYYY' ) as actuacion"),
                    DB::raw("to_char( juicios.movimiento  ,'DD/MM/YYYY' ) as movimiento"),
                    DB::raw("to_char( juicios.creacion  ,'DD/MM/YYYY' ) as creacion"),
                    /*
                    DB::raw(" date_format( juicios.admision, '%d/%m/%Y' ) as admision "),
                    DB::raw(" date_format( juicios.asignacion, '%d/%m/%Y' ) as asignacion "),
                    DB::raw(" date_format( juicios.actuacion, '%d/%m/%Y' ) as actuacion "),
                    DB::raw(" date_format( juicios.movimiento, '%d/%m/%Y' ) as movimiento "),
                    DB::raw(" date_format( juicios.creacion, '%d/%m/%Y' ) as creacion "),
                    */
                    'datos.capital',
                    'datos.monto',
                    DB::raw("(CASE datos.tasa WHEN  'F' THEN 'Fija' WHEN 'V' THEN 'Variable' ELSE 'Sin Valor' END) AS tasa"),
                    'datos.mora',
                    'datos.interes',
                    'datos.observacion',
                    'datos.juez',
                )
                ->join('tribunales', 'tribunales.id', "=", 'juicios.tribunal_id')
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
                ->join('especialidades', 'especialidades.id', "=", 'juicios.especialidad_id')
                ->leftJoin('datos', 'datos.juicio_id', "=", 'juicios.id')
                ->orderBy('juicios.id', 'desc')
                ->whereNull('juicios.deleted_at')
                ->get();

            Cache::put('juicios', $juicios);
        }
        return $juicios;
    }

    static  public function getJuiciosUltimoSeguimiento()
    {
        $ultimoSeguimientos = DB::table('seguimientos as s')->whereNull('s.deleted_at')
            ->select('s.id', 's.juicio_id', 's.actividad_id', 's.seguimiento')
            ->whereRaw('s.id in (select max(id) 
          
    from seguimientos 
    group by (juicio_id) ) 
    order by (juicio_id) desc ');
        $juicios = DB::table('juicios as j')
            ->join('tribunales as t', 't.id', "=", 'j.tribunal_id')
            ->join('juzgados as ju', 'ju.id', "=", 't.juzgado_id')
            ->join('procedencias as p', 'p.id', "=", 'j.procedencia_id')
            ->join('ubicaciones as u', 'u.id', "=", 'j.ubicacion_id')
            ->join('especialidades as espe', 'espe.id', "=", 'j.especialidad_id')
            ->join('estatus as esta', 'esta.id', "=", 'j.estatu_id')
            ->join('internos as i', 'i.id', "=", 'j.interno_id')
            ->join('externos as exte', 'exte.id', "=", 'j.externo_id')
            ->join('obligaciones as o', 'o.id', "=", 'j.obligacion_id')
            ->join('estados as e', 'e.id', "=", 'j.estado_id')
            ->join('demandas as d', 'd.id', "=", 'j.demanda_id')
            ->join('pretensiones as pret', 'pret.id', "=", 'j.pretension_id')
            ->join('garantias as g', 'g.id', "=", 'j.garantia_id')
            ->join('medidas as m', 'm.id', "=", 'j.medida_id')
            ->joinSub($ultimoSeguimientos, 'ultimo_seguimientos', function ($join) {
                $join->on('j.id', '=', 'ultimo_seguimientos.juicio_id');
            })
            ->join('actividades as a', 'a.id', "=", 'ultimo_seguimientos.actividad_id')
            ->select(
                'j.id as juicio_id',
                'ultimo_seguimientos.id as seguimiento_id',
                DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                'j.especialidad_id',
                'espe.descripcion as e_especialidad',
                DB::raw("(CASE j.origen WHEN  'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS j_origen"),
                'p.descripcion as procedencia',
                'u.descripcion as ubicacion',
                DB::raw("(CASE WHEN esta.terminado = 'S' THEN 'SI' ELSE 'NO' END) AS e_terminado"),
                'esta.descripcion as estatu',
                'j.expediente',
                't.descripcion as tribunal',
                'ju.descripcion as juzgado',
                'i.nombre as interno',
                'exte.nombre as externo',
                'o.descripcion as obligacion',
                'e.descripcion as estado_procesal',
                'd.descripcion as demanda',
                'pret.descripcion as pretension',
                'g.descripcion as garantia',
                DB::raw("(CASE WHEN j.llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS j_llevado"),
                'm.descripcion as medida',
                DB::raw("(CASE WHEN j.practicada = 'S' THEN 'SI' ELSE 'NO' END) AS j_practicada"),
                DB::raw("(CASE j.moneda WHEN  'BS' THEN 'Bolívares' WHEN 'NA' THEN 'Sin Valor' ELSE 'Dólares' END) AS j_moneda"),
                DB::raw("to_char( j.admision  ,'DD/MM/YYYY' ) as admision"),
                DB::raw("to_char( j.asignacion  ,'DD/MM/YYYY' ) as asignacion"),
                DB::raw("to_char( j.actuacion  ,'DD/MM/YYYY' ) as actuacion"),
                DB::raw("to_char( j.creacion  ,'DD/MM/YYYY' ) as creacion"),
                /* 
                DB::raw(" date_format( j.admision, '%d/%m/%Y' ) as admision "),
                DB::raw(" date_format( j.asignacion, '%d/%m/%Y' ) as asignacion "),
                DB::raw(" date_format( j.actuacion, '%d/%m/%Y' ) as actuacion "),
                DB::raw(" date_format( j.creacion, '%d/%m/%Y' ) as creacion "),
                */
                'a.descripcion as actividad_procesal',
                'ultimo_seguimientos.seguimiento as seguimiento',
            )
            ->whereNull('j.deleted_at')
            ->orderBy('j.id', 'desc')

            ->get();
        return $juicios;
    }

    static  public function getJuiciosUltimoMovimiento()
    {

        $ultimoMovimientos = DB::table('movimientos as m')->whereNull('m.deleted_at')
            ->select('m.id', 'm.juicio_id', 'm.movimiento')
            ->whereRaw('m.id in (select max(id) 
    from movimientos 
    group by (juicio_id) ) 
    order by (juicio_id) desc ');
        $juicios = DB::table('juicios as j')
            ->join('tribunales as t', 't.id', "=", 'j.tribunal_id')
            ->join('juzgados as ju', 'ju.id', "=", 't.juzgado_id')
            ->join('procedencias as p', 'p.id', "=", 'j.procedencia_id')
            ->join('ubicaciones as u', 'u.id', "=", 'j.ubicacion_id')
            ->join('especialidades as espe', 'espe.id', "=", 'j.especialidad_id')
            ->join('estatus as esta', 'esta.id', "=", 'j.estatu_id')
            ->join('internos as i', 'i.id', "=", 'j.interno_id')
            ->join('externos as exte', 'exte.id', "=", 'j.externo_id')
            ->join('obligaciones as o', 'o.id', "=", 'j.obligacion_id')
            ->join('estados as e', 'e.id', "=", 'j.estado_id')
            ->join('demandas as d', 'd.id', "=", 'j.demanda_id')
            ->join('pretensiones as pret', 'pret.id', "=", 'j.pretension_id')
            ->join('garantias as g', 'g.id', "=", 'j.garantia_id')
            ->join('medidas as m', 'm.id', "=", 'j.medida_id')
            ->joinSub($ultimoMovimientos, 'ultimo_movimientos', function ($join) {
                $join->on('j.id', '=', 'ultimo_movimientos.juicio_id');
            })
            ->select(
                'j.id as juicio_id',
                'ultimo_movimientos.id as movimiento_id',
                DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                'j.especialidad_id',
                'espe.descripcion as e_especialidad',
                DB::raw("(CASE j.origen WHEN  'F' THEN 'Fogade' WHEN 'B' THEN 'Banca en Liquidación' WHEN 'A' THEN 'Fogade / Banca en Liquidación'  ELSE 'Crédito Cedido a Fogade' END) AS j_origen"),
                'p.descripcion as procedencia',
                'u.descripcion as ubicacion',
                DB::raw("(CASE WHEN esta.terminado = 'S' THEN 'SI' ELSE 'NO' END) AS e_terminado"),
                'esta.descripcion as estatu',
                'j.expediente',
                't.descripcion as tribunal',
                'ju.descripcion as juzgado',
                'i.nombre as interno',
                'exte.nombre as externo',
                'o.descripcion as obligacion',
                'e.descripcion as estado_procesal',
                'd.descripcion as demanda',
                'pret.descripcion as pretension',
                'g.descripcion as garantia',
                DB::raw("(CASE WHEN j.llevado = 'CJ' THEN 'Consultoría Jurídica' ELSE 'Abogado Externo' END) AS j_llevado"),
                'm.descripcion as medida',
                DB::raw("(CASE WHEN j.practicada = 'S' THEN 'SI' ELSE 'NO' END) AS j_practicada"),
                DB::raw("(CASE j.moneda WHEN  'BS' THEN 'Bolívares' WHEN 'NA' THEN 'Sin Valor' ELSE 'Dólares' END) AS j_moneda"),
                DB::raw("to_char( j.admision  ,'DD/MM/YYYY' ) as admision"),
                DB::raw("to_char( j.asignacion  ,'DD/MM/YYYY' ) as asignacion"),
                DB::raw("to_char( j.movimiento  ,'DD/MM/YYYY' ) as movimiento"),
                /* 
                DB::raw(" date_format( j.admision, '%d/%m/%Y' ) as admision "),
                DB::raw(" date_format( j.asignacion, '%d/%m/%Y' ) as asignacion "),
                DB::raw(" date_format( j.movimiento, '%d/%m/%Y' ) as movimiento "),
                */
                'ultimo_movimientos.movimiento as m_movimiento',
            )
            ->whereNull('j.deleted_at')
            ->orderBy('j.id', 'desc')
            ->get();
        return $juicios;
    }

    static  public function getTodosPersonas()
    {
        $modeloPersonas = DB::table('personas as p')->whereNull('p.deleted_at')
            ->select(
                'p.id as id',
                'p.nombre as p_persona',
                'p.juicio_id as juicio_id',
                'p.configuracion_id as configuracion_id ',
                'c.especialidad_id as c_especialidad_id',
                'c.descripcion as c_descripcion',
                DB::raw("(CASE e.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS internacional"),
                'e.descripcion  as e_descripcion',
                'j.id as id_juicio',
            )
            ->join('configuraciones as c', 'c.id', "=", 'p.configuracion_id')
            ->join('especialidades as e', 'e.id', "=", 'c.especialidad_id')
            ->join('juicios as j', 'j.id', "=", 'p.juicio_id')
            ->whereNull('j.deleted_at')
            ->orderBy('p.nombre', 'asc')
            ->get();
        return  $modeloPersonas;
    }
    static  public function getTodosJuiciosEloquent()
    {
        $juicios = Juicio::with([
            'especialidad:id,descripcion',
            'procedencia:id,descripcion',
            'ubicacion:id,descripcion',
            'estatu:id,descripcion,terminado',
            'interno:id,nombre',
            'externo:id,nombre',
            'obligacion:id,descripcion',
            'estado:id,descripcion',
            'demanda:id,descripcion',
            'pretension:id,descripcion',
            'garantia:id,descripcion',
            'medida:id,descripcion',
            'dato:id,juicio_id,tasa,capital,monto,mora,interes,observacion,juez',
            'tribunal:id,descripcion,juzgado_id',
            'tribunal.juzgado:id,descripcion',
        ])
            ->get();
        return $juicios;
    }

    static  public function getJuiciosUSMEloquent()
    {
        $juicios =  Juicio::orderBy('id', 'desc')
            ->with([
                'dato:id,juicio_id,tasa,capital,monto,mora,interes,observacion,juez',
                'tribunal:id,descripcion,juzgado_id',
                'tribunal.juzgado:id,descripcion',
                'garantia:id,descripcion',
                'procedencia:id,descripcion',
                'ubicacion:id,descripcion',
                'estatu:id,descripcion,terminado',
                'interno:id,nombre',
                'externo:id,nombre',
                'obligacion:id,descripcion',
                'estado:id,descripcion',
                'demanda:id,descripcion',
                'pretension:id,descripcion',
                'medida:id,descripcion',
                'especialidad:id,descripcion'
            ])
            ->withUltimoSeguimiento()
            ->with('ultimoSeguimiento.actividad:id,descripcion')
            ->WithUltimoMovimiento()
            ->get();
        return $juicios;
    }
    /*
        $ultimoSeguientos = DB::table('seguimientos as s')
            ->select('juicio_id', DB::raw(' MAX(id) as ultimo_segui_id '))
            ->groupBy('juicio_id')
            //->orderBy('id', 'desc')
            ->get();
        return $ultimoSeguientos;
        return 'ok';

        $ultimoSeguiento = DB::table('seguimientos as s')
            ->select('s.id', 's.juicio_id', 's.actividad_id', 'a.descripcion', 's.fecha', 's.seguimiento')
            ->join('actividades as a', 'a.id', "=", 's.actividad_id')
            ->whereRaw('s.id in (select max(id) 
        from seguimientos 
        group by (juicio_id) ) 
        order by (juicio_id) desc ')
           ->get();
        return 'ok';
        return $ultimoSeguiento ;

        $latestPosts = DB::table('posts')
            ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
            ->where('is_published', true)
            ->groupBy('user_id');

        $users = DB::table('users')
            ->joinSub($latestPosts, 'latest_posts', function ($join) {
                $join->on('users.id', '=', 'latest_posts.user_id');
            })->get();
    */

    /*
        $mdoleoPersonas = Persona::with([
            'configuracion:id,especialidad_id,descripcion',
            'configuracion.especialidad:id,internacional,descripcion'

        ])
        ->orderBy('nombre','asc')->get();
        */
    //return  $mdoleoPersonas ;

    /*
        $personas = DB::table('personas')
        ->select('nombre')
        ->groupBy('nombre')
        ->orderBy('nombre','asc')
        ->get();
        */
    //return  $personas ;
}
