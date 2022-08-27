<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Configuracion;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ConfiguracionController extends Controller
{
    public function byEspecialidad($id)
    {
        //
        $configuracion = DB::table('configuraciones')
            ->where('especialidad_id', $id)
            ->get();
        return $configuracion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.configuraciones')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isEspecialidades()) {
                $role = 'especialidades';
            }
            if (request()->ajax()) {
                $configuraciones = Configuracion::with([
                    'especialidad:id,internacional,descripcion'
                ])
                    ->get();
                return datatables()::of($configuraciones)
                    ->addColumn('botones', 'configuraciones.botones')
                    ->rawColumns(['botones'])
                    ->toJson();
            }
            return view('configuraciones.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.configuraciones')) { // you can pass an id or slug
            $especialidades = Especialidad::pluck('descripcion', 'id');
            return view('configuraciones.create', compact('especialidades'));
        }
        return redirect()->route('configuraciones.index')->with('success', 'Usuario no autorizado, para crear configuración de las especialidades.');
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
        $especialidad_id = $request->input('especialidad_id');
        $descripcion = $request->input('descripcion');

        $buscar = DB::table('configuraciones')
            ->where('especialidad_id', $especialidad_id)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La especialidad y descripción, ya existe',
            ]);
        } else {
            $configuracion = Configuracion::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La especialidad y descripción, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuracion $configuracion)
    {
        //
        if (Auth::user()->hasPermission('crear.configuraciones')) { // you can pass an id or slug
            $internacional = DB::table('especialidades')
                ->where('id',  $configuracion->especialidad_id)
                ->get();
            $valorInternacional = $internacional[0]->internacional;
            $especialidades = Especialidad::where('internacional', $valorInternacional)->pluck('descripcion', 'id');
            return view('configuraciones.edit', compact('configuracion', 'especialidades', 'valorInternacional'));
        }
        return redirect()->route('configuraciones.index')->with('success', 'Usuario no autorizado, para editar configuración de las especialidades.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuracion $configuracion)
    {
        //
        $especialidad_id = $request->input('especialidad_id');
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('configuraciones')
            ->where('especialidad_id', $especialidad_id)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La especialidad y descripción, ya existe',
            ]);
        } else {
            $configuracion->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La especialidad y descripción, se actualizó con éxito',
            ]);
        }
    }


    public function restore($id)

    {
        //
        $configuracion = Configuracion::onlyTrashed()->find($id);
        $configuracion->restore();
    }

    public function forceDelete($id)

    {
        //
        $configuracion = Configuracion::onlyTrashed()->find($id);
        $configuracion->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_actor = Actor::join('configuraciones', 'configuraciones.id', "=", 'actores.configuracion_id')
            ->where('actores.configuracion_id', '=', $id)
            ->get();
        if (count($existe_actor) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La configuración, esta relacionada con alguna parte actora',
            ]);
        } else {
            $eliminar = Configuracion::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La configuración, se eliminó con éxito',
            ]);
            return redirect()->route('configuraciones.index');
        }
    }
}
