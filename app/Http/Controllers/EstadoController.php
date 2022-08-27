<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstado;
use App\Models\Estado;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.procesal')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $estados = Estado::get(); //select("estados.id", "estados.descripcion");
                return datatables()::of($estados)
                    ->addColumn('botones', 'estados.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('estados.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.procesal')) { // you can pass an id or slug
            return view('estados.create');
        }
        return redirect()->route('estados.index')->with('success', 'Usuario no autorizado, para crear estado procesal.');
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
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('estados')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estado procesal, ya existe',
            ]);
        } else {
            $estado = Estado::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El estado procesal, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
        if (Auth::user()->hasPermission('editar.procesal')) { // you can pass an id or slug
            return view('estados.edit', compact('estado'));
        }
        return redirect()->route('estados.index')->with('success', 'Usuario no autorizado, para editar estado procesal.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('estados')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estado procesal, ya existe',
            ]);
        } else {
            $estado->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El estado procesal, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $estado = Estado::onlyTrashed()->find($id);
        $estado->restore();
    }

    public function forceDelete($id)

    {
        //
        $estado = Estado::onlyTrashed()->find($id);
        $estado->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_estado = Juicio::join('estados', 'estados.id', "=", 'juicios.estado_id')
            ->where('juicios.estado_id', '=', $id)
            ->get();
        if (count($existe_estado) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estado procesal esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Estado::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El estado procesal se eliminó con éxito',
            ]);
            return redirect()->route('estados.index');
        }
    }
}
