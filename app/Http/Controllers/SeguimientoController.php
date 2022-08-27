<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Juicio;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Auth;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
    public function index($id)
    {
        //
        if (Auth::user()->hasPermission('ver.actuaciones')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isAbogado()) {
                $role = 'abogado';
            }
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (Auth::user()->isConsulta()) {
                $role = 'consulta';
            }
            $dataJuicio = $id;
            if (request()->ajax()) {
                $seguimientos = Seguimiento::with('actividad:id,descripcion')
                    ->where('juicio_id', $dataJuicio)
                    ->orderBy('fecha', 'desc')
                    ->get();
                return datatables()::of($seguimientos)
                    ->addColumn('botones', 'seguimientos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('seguimientos.index', compact('dataJuicio', 'role'));
        }
        return redirect()->route('juicios.index')->with('success', 'Usuario no autorizado, para ver actuaciones del juicio.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        if (Auth::user()->hasPermission('crear.actuaciones')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $dataJuicio = $id;
            $actividades = Actividad::pluck('descripcion', 'id');
            return view('seguimientos.create', compact('actividades', 'dataJuicio', 'usuario'));
        }
        return redirect()->route('seguimientos.index', $id)->with('success', 'Usuario no autorizado, para crear actuaciones del juicio.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $seguimiento = Seguimiento::create($request->all());

        $juicio_id = $request->input('juicio_id');

        $primerSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'asc')
            ->where('juicio_id', $juicio_id)
            ->first();
        $juicio = Juicio::find($primerSeguimiento->juicio_id);
        $juicio->creacion = $primerSeguimiento->fecha_seguimiento;
        $juicio->save();

        $ultimoSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->first();
        $juicio = Juicio::find($ultimoSeguimiento->juicio_id);
        $juicio->actuacion = $ultimoSeguimiento->fecha_seguimiento;
        $juicio->save();

        $ultimoSeguimientoActividadCinco = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->where('actividad_id', '5')
            ->first();

        if (empty($ultimoSeguimientoActividadCinco->id)) {
        } else {
            $juicio = Juicio::find($ultimoSeguimientoActividadCinco->juicio_id);
            $juicio->admision = $ultimoSeguimientoActividadCinco->fecha_seguimiento;
            $juicio->save();
        }

        return back();
        //return redirect()->route('seguimientos.edit', $seguimiento)->with('info','Los datos se crearón con éxito');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguimiento $seguimiento)
    {
        //
        if (Auth::user()->hasPermission('editar.actuaciones')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $actividades = Actividad::pluck('descripcion', 'id');
            return view('seguimientos.edit', compact('actividades', 'seguimiento', 'usuario'));
        }
        return redirect()->route('seguimientos.index', $seguimiento->juicio_id)->with('success', 'Usuario no autorizado, para editar actuaciones del juicio.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguimiento $seguimiento)
    {
        //

        $seguimiento->update($request->all());

        //$juicio_id = $request->input('juicio_id');

        $primerSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'asc')
            ->where('juicio_id', $seguimiento->juicio_id)
            ->first();
        if (empty($primerSeguimiento->id)) {
        } else {
            $juicio = Juicio::find($primerSeguimiento->juicio_id);
            $juicio->creacion = $primerSeguimiento->fecha_seguimiento;
            $juicio->save();
        }

        $ultimoSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $seguimiento->juicio_id)
            ->first();
        if (empty($ultimoSeguimiento->id)) {
        } else {
            $juicio = Juicio::find($ultimoSeguimiento->juicio_id);
            $juicio->actuacion = $ultimoSeguimiento->fecha_seguimiento;
            $juicio->save();
        }

        $ultimoSeguimientoActividadCinco = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $seguimiento->juicio_id)
            ->where('actividad_id', '5')
            ->first();
        if (empty($ultimoSeguimientoActividadCinco->id)) {
        } else {
            $juicio = Juicio::find($ultimoSeguimientoActividadCinco->juicio_id);
            $juicio->admision = $ultimoSeguimientoActividadCinco->fecha_seguimiento;
            $juicio->save();
        }

        return redirect()->route('seguimientos.index', $seguimiento->juicio_id);
    }

    public function restore($id)

    {
        //
        $seguimiento = Seguimiento::onlyTrashed()->find($id);
        $seguimiento->restore();
    }

    public function forceDelete($id)

    {
        //
        $seguimiento = Seguimiento::onlyTrashed()->find($id);
        $seguimiento->forceDelete();
    }

    public function eliminar($id)

    {
        //

        $eliminar = Seguimiento::find($id);
        $juicio_id = $eliminar->juicio_id;

        $juicio = Juicio::find($juicio_id);
        $juicio->creacion = null;
        $juicio->actuacion = null;
        $juicio->save();

        $eliminar->delete();

        $primerSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'asc')
            ->where('juicio_id', $juicio_id)
            ->first();


        if (empty($primerSeguimiento->id)) {
        } else {
            $juicio = Juicio::find($primerSeguimiento->juicio_id);
            $juicio->creacion = $primerSeguimiento->fecha_seguimiento;
            $juicio->save();
        }

        $ultimoSeguimiento = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->first();



        if (empty($ultimoSeguimiento->id)) {
        } else {
            $juicio = Juicio::find($ultimoSeguimiento->juicio_id);
            $juicio->actuacion = $ultimoSeguimiento->fecha_seguimiento;
            $juicio->save();
        }


        $ultimoSeguimientoActividadCinco = Seguimiento::select("seguimientos.id", "seguimientos.juicio_id", "seguimientos.fecha", "seguimientos.actividad_id")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->where('actividad_id', '5')
            ->first();
        if (empty($ultimoSeguimientoActividadCinco->id)) {
        } else {
            $juicio = Juicio::find($ultimoSeguimientoActividadCinco->juicio_id);
            $juicio->admision = $ultimoSeguimientoActividadCinco->fecha_seguimiento;
            $juicio->save();
        }
        return back();
    }
}
