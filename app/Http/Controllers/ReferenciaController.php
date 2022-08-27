<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Referencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.actores')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $referencia = Referencia::get();
                return datatables()::of($referencia)
                    ->addColumn('botones', 'referencias.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('referencias.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.actores')) { // you can pass an id or slug
            return view('referencias.create');
        }
        return redirect()->route('referencias.index')->with('success', 'Usuario no autorizado, para crear partes procesales.');
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
        $tipo = $request->input('tipo');
        $numero = $request->input('numero');
        $rif = $request->input('rif');
        $buscar = DB::table('referencias')
            ->where('tipo', $tipo)
            ->where('numero', $numero)
            ->where('rif', $rif)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La parte actora, ya existe',
            ]);
        } else {
            $pretension = Referencia::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La parte actora, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Referencia $referencia)
    {
        // 
        if (Auth::user()->hasPermission('editar.actores')) { // you can pass an id or slug
            return view('referencias.edit', compact('referencia'));
        }
        return redirect()->route('referencias.index')->with('success', 'Usuario no autorizado, para editar partes procesales.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referencia $referencia)
    {
        //
        $referencia->update($request->all());
        return response()->json([
            'result' => 'success',
            'msj'    => 'La parte actoral, se actualizó con éxito',
        ]);
    }



    public function restore($id)

    {
        //
        $referencia = Referencia::onlyTrashed()->find($id);
        $referencia->restore();
    }

    public function forceDelete($id)

    {
        //
        $referencia = Referencia::onlyTrashed()->find($id);
        $referencia->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_actor = Actor::join('referencias', 'referencias.id', "=", 'actores.referencia_id')
            ->where('actores.referencia_id', '=', $id)
            ->get();
        if (count($existe_actor) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La parte actora, esta relacionada con algún juicio',
            ]);
        } else {
            $eliminar = Referencia::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La parte actora, se eliminó con éxito',
            ]);
            return redirect()->route('referencias.index');
        }
    }

    public function consulta()
    {
        if (Auth::user()->hasPermission('ver.actores')) { // you can pass an id or slug
            $referencias = Referencia::with([
                'actores:id,juicio_id,configuracion_id,referencia_id,tipo',
                'actores.configuracion:id,especialidad_id,descripcion',
                'actores.configuracion.especialidad:id,internacional,descripcion'
            ])
                ->get();
            return view('referencias.consulta', compact('referencias'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }
}
