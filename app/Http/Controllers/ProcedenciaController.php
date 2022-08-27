<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedencia;
use App\Models\Juicio;
use App\Models\Procedencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ProcedenciaController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.procedencias')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $procedencias = Procedencia::get(); // select("procedencias.id", "procedencias.codigo", "procedencias.descripcion");
                return datatables()::of($procedencias)
                    ->addColumn('botones', 'procedencias.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('procedencias.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.procedencias')) { // you can pass an id or slug
            return view('procedencias.create');
        }
        return redirect()->route('procedencias.index')->with('success', 'Usuario no autorizado, para crear procedencias.');
    }
    public function store(Request $request)
    {
        //

        $codigo = $request->input('codigo');
        $descripcion = $request->input('descripcion');

        $buscarCod = DB::table('procedencias')
            ->where('codigo', $codigo)
            ->get();
        if (count($buscarCod) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El código, ya existe',
            ]);
        } else {
            $buscar = DB::table('procedencias')
                ->where('codigo', $codigo)
                ->where('descripcion', $descripcion)
                ->get();
            if (count($buscar) > 0) {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'El código y descripción de la procedencia, ya existe',
                ]);
            } else {
                $procedencia = Procedencia::create($request->all());
                return response()->json([
                    'result' => 'success',
                    'msj'    => 'El código y descripción de la procedencia, se creó con éxito',
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedencia $procedencia)
    {
        //
        if (Auth::user()->hasPermission('editar.procedencias')) { // you can pass an id or slug
            return view('procedencias.edit', compact('procedencia'));
        }
        return redirect()->route('procedencias.index')->with('success', 'Usuario no autorizado, para editar procedencias.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedencia $procedencia)
    {
        //
        $codigo = $request->input('codigo');
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('procedencias')
            ->where('codigo', $codigo)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El código y descripción de la procedencia, ya existe',
            ]);
        } else {
            $procedencia->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El código y descripción de la procedencia, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $procedencia = Procedencia::onlyTrashed()->find($id);
        $procedencia->restore();
    }

    public function forceDelete($id)

    {
        //
        $procedencia = Procedencia::onlyTrashed()->find($id);
        $procedencia->forceDelete();
    }

    public function eliminar($id)

    {
        $existe_procedencia = Juicio::join('procedencias', 'procedencias.id', "=", 'juicios.procedencia_id')
            ->where('juicios.procedencia_id', '=', $id)
            ->get();
        if (count($existe_procedencia) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La procedencia esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Procedencia::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La procedencia se eliminó con éxito',
            ]);
            return redirect()->route('procedencias.index');
        }
    }
}
