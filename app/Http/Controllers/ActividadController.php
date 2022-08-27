<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActividad;
use App\Models\Actividad;
use App\Models\Juicio;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.actividad')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $actividades = Actividad::get();
                //select("actividades.id", "actividades.descripcion");
                return datatables()::of($actividades)
                    ->addColumn('botones', 'actividades.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('actividades.index', compact('role'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->hasPermission('crear.actividad')) { // you can pass an id or slug
            return view('actividades.create');
        }
        return redirect()->route('actividades.index')->with('success', 'Usuario no autorizado, para crear actividad procesal.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('actividades')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La actividad procesal, ya existe',
            ]);
        } else {
            $actividad = Actividad::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La actividad procesal, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
        if (Auth::user()->hasPermission('editar.actividad')) { // you can pass an id or slugF
            return view('actividades.edit', compact('actividad'));
        }
        return redirect()->route('actividades.index')->with('success', 'Usuario no autorizado, para editar actividad procesal.');
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('actividades')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La actividad procesal, ya existe',
            ]);
        } else {
            $actividad->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La actividad procesal, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $actividad = Actividad::onlyTrashed()->find($id);
        $actividad->restore();
    }

    public function forceDelete($id)

    {
        //
        $actividad = Actividad::onlyTrashed()->find($id);
        $actividad->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_actividad = Seguimiento::join('actividades', 'actividades.id', "=", 'seguimientos.actividad_id')
            ->where('seguimientos.actividad_id', '=', $id)
            ->get();
        if (count($existe_actividad) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La actividad procesal esta relacionada con algún seguimiento de juicio',
            ]);
        } else {
            $eliminar = Actividad::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La actividad procesal se eliminó con éxito',
            ]);
            return redirect()->route('externos.index');
        }
    }
}
