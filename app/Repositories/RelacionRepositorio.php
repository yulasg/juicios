<?php

namespace App\Repositories;

use App\Models\Relacion;
use Illuminate\Support\Facades\DB;

class RelacionRepositorio
{

    static  public function getRelacionModelo1($id)
    {
        $dataJuicio = $id;
        $relaciones1 = Relacion::with([
            'juicio1:id,especialidad_id,expediente,interno_id,procedencia_id,admision,asignacion,actuacion,movimiento,creacion,internacional',
            'juicio1.interno:id,nombre',
            'juicio1.especialidad:id,descripcion as rama',
            'juicio1.procedencia:id,descripcion',
            'juicio1.dato:id,juicio_id,capital,monto',
            'juicio1.personas:id,juicio_id,nombre,configuracion_id,rif,persona,numero,celular,habitacion',
            'juicio1.actores:id,juicio_id,configuracion_id,referencia_id,tipo',
            'juicio1.actores.configuracion:id,especialidad_id,descripcion',
            'juicio1.actores.configuracion.especialidad:id,internacional,descripcion',
            'juicio1.actores.referencia:id,tipo,numero,rif,nombre,direccion,habitacion,celular_principal,celular_secundario,email_principal,email_secundario'
        ])
            ->where('juicio_id', $dataJuicio)
            ->get();
        return  $relaciones1;
    }

    static  public function getRelacionModelo2($id)
    {
        $dataJuicio = $id;
        $relaciones2 = Relacion::with([
            'juicio:id,especialidad_id,expediente,interno_id,procedencia_id,admision,asignacion,actuacion,movimiento,creacion,internacional',
            'juicio.interno:id,nombre',
            'juicio.especialidad:id,descripcion as rama',
            'juicio.procedencia:id,descripcion',
            'juicio.dato:id,juicio_id,capital,monto',
            'juicio.personas:id,juicio_id,nombre,configuracion_id,rif,persona,numero,celular,habitacion',
            'juicio.actores:id,juicio_id,configuracion_id,referencia_id,tipo',
            'juicio.actores.configuracion:id,especialidad_id,descripcion',
            'juicio.actores.configuracion.especialidad:id,internacional,descripcion',
            'juicio.actores.referencia:id,tipo,numero,rif,nombre,direccion,habitacion,celular_principal,celular_secundario,email_principal,email_secundario'
        ])
            ->where('juicio1_id', $dataJuicio)
            ->get();
        return  $relaciones2;
    }

    static  public function getRelacionBD1($id)
    {
        $dataJuicio = $id;
        if ($juicioRelacionado = Relacion::where('juicio_id', $dataJuicio)->exists()) {
            $relaciones1  = DB::table('relaciones as relacion')->where('relacion.juicio_id', $dataJuicio)
                ->join('juicios as j',  'j.id', '=', 'relacion.juicio1_id')
                ->join('internos as i', 'i.id', "=", 'j.interno_id')
                ->join('procedencias as proce', 'proce.id', "=", 'j.procedencia_id')
                ->leftJoin('datos as d',   'd.juicio_id', "=", 'j.id')
                ->leftJoin('personas as p',   'p.juicio_id', "=", 'j.id')
                ->leftJoin('actores as a', 'a.juicio_id', "=", 'j.id')
                ->leftJoin('configuraciones as c', 'c.id', "=", 'a.configuracion_id')
                ->select(
                    "relacion.id as relacion_id",
                    "j.id as juicio_id",
                    DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                    "j.expediente as expediente",
                    "j.creacion as creacion",
                    "j.admision as admision",
                    "d.monto as monto",
                    "d.capital as capital",
                    "i.nombre as interno",
                    "proce.descripcion as procedencia",
                    "p.id as persona_id",
                    "p.persona as tipo",
                    "p.nombre as nombre",
                    "p.configuracion_id as configuracion_id",
                    "a.id as actor_id",
                    "c.descripcion as ac_descripcion",

                )
                ->orderByDesc('relacion_id')
                ->get();
            return  $relaciones1;
        }
    }

    static  public function getRelacionBD2($id)
    {
        $dataJuicio = $id;
        if ($juicioRelacionado = Relacion::where('juicio1_id', $dataJuicio)->exists()) {
            $relaciones2  = DB::table('relaciones as r')->where('juicio1_id', $dataJuicio)
                ->join('juicios as j', 'j.id', "=", 'r.juicio_id')
                ->leftJoin('datos as d', 'd.juicio_id', "=", 'j.id')
                ->leftJoin('personas as p', 'p.juicio_id', "=", 'j.id')
                ->join('configuraciones as c', 'c.id', "=", 'p.configuracion_id')
                ->join('especialidades as e', 'e.id', "=", 'c.especialidad_id')
                ->join('internos as i', 'i.id', "=", 'j.interno_id')
                ->join('procedencias as proce', 'proce.id', "=", 'j.procedencia_id')
                ->select(
                    "r.id as relacion_id",
                    "j.id as juicio_id",
                    DB::raw("(CASE j.internacional WHEN  'N' THEN 'Nacional' ELSE 'Internacional' END) AS j_internacional"),
                    "j.expediente as expediente",
                    "j.creacion as creacion",
                    "j.admision as admision",
                    "d.monto as monto",
                    "d.capital as capital",
                    "i.nombre as interno",
                    "proce.descripcion as procedencia",
                    "p.id as persona_id",
                    "p.persona as tipo",
                    "p.nombre as nombre",
                    "p.persona as tipo",
                    "p.configuracion_id as configuracion_id",
                    "c.descripcion as c_ descripcion",
                    "e.descripcion as e_ descripcion"
                )
                ->orderByDesc('relacion_id')
                ->get();
            return  $relaciones2;
        }
    }
}
