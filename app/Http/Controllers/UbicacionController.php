<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUbicacion;
use App\Models\Juicio;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UbicacionController extends Controller
{
    //
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.ubicaciones')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $ubicaciones = Ubicacion::get(); // select("ubicaciones.id", "ubicaciones.descripcion");
                return datatables()::of($ubicaciones)
                    ->addColumn('botones', 'ubicaciones.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('ubicaciones.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.ubicaciones')) { // you can pass an id or slug
            return view('ubicaciones.create');
        }
        return redirect()->route('ubicaciones.index')->with('success', 'Usuario no autorizado, para crear estados.');
    }
    public function store(Request $request)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('ubicaciones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estado, ya existe',
            ]);
        } else {
            $ubicacion = Ubicacion::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El estado, se creó con éxito',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
        if (Auth::user()->hasPermission('editar.ubicaciones')) { // you can pass an id or slug
            return view('ubicaciones.edit', compact('ubicacion'));
        }
        return redirect()->route('ubicaciones.index')->with('success', 'Usuario no autorizado, para editar estados.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request   
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('ubicaciones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estado, ya existe',
            ]);
        } else {
            $ubicacion->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El estado, se actualizó con éxito',
            ]);
        }
    }
    public function restore($id)

    {
        //
        $ubicacion = Ubicacion::onlyTrashed()->find($id);
        $ubicacion->restore();
    }

    public function forceDelete($id)

    {
        //
        $ubicacion = Ubicacion::onlyTrashed()->find($id);
        $ubicacion->forceDelete();
    }
    public function eliminar($id)

    {
        //
        $existe_ubicacion = Juicio::join('ubicaciones', 'ubicaciones.id', "=", 'juicios.ubicacion_id')
            ->where('juicios.ubicacion_id', '=', $id)
            ->get();
        if (count($existe_ubicacion) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La ubicación esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Ubicacion::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La ubicación se eliminó con éxito',
            ]);
            return redirect()->route('ubicaciones.index');
        }
    }
}
