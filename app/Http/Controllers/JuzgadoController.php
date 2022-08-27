<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJuzgado;
use App\Models\Juzgado;
use App\Models\Tribunal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class JuzgadoController extends Controller
{

    public function allJuzgados()
    {
        //
        $juzgados = Juzgado::all();
        return $juzgados;
        //return Tribunal::where('juzgado_id', $id)->get();
    }

    public function byTribunal($id)
    {
        //
        $tribunales = Tribunal::find($id);
        return $tribunales = $tribunales->juzgado;
        //return Juzgado::where('id', $id)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        if (Auth::user()->hasPermission('ver.juzgados')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $juzgados = Juzgado::get(); // select("juzgados.id", "juzgados.descripcion");
                return datatables()::of($juzgados)
                    ->addColumn('botones', 'juzgados.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('juzgados.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.juzgados')) { // you can pass an id or slug
            return view('juzgados.create');
        }
        return redirect()->route('juzgados.index')->with('success', 'Usuario no autorizado, para crear juzgados.');
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
        $buscar = DB::table('juzgados')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El juzgado, ya existe',
            ]);
        } else {
            $juzgado = Juzgado::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El juzgado, se creó con éxito',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Juzgado $juzgado)
    {
        //
        if (Auth::user()->hasPermission('editar.juzgados')) { // you can pass an id or slug
            return view('juzgados.edit', compact('juzgado'));
        }
        return redirect()->route('juzgados.index')->with('success', 'Usuario no autorizado, para editar juzgados.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Juzgado $juzgado)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('juzgados')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El juzgado, ya existe',
            ]);
        } else {
            $juzgado->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El juzgado, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $juzgado = Juzgado::onlyTrashed()->find($id);
        $juzgado->restore();
    }

    public function forceDelete($id)

    {
        //
        $juzgado = Juzgado::onlyTrashed()->find($id);
        $juzgado->forceDelete();
    }

    public function eliminar($id)

    {
        //

        $existe_tribunal = Tribunal::join('juzgados', 'juzgados.id', "=", 'tribunales.juzgado_id')
            ->where('tribunales.juzgado_id', '=', $id)
            ->get();
        if (count($existe_tribunal) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El juzgado esta relacionado con algún tribunal',
            ]);
        } else {
            $eliminar = Juzgado::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El juzgado se eliminó con éxito',
            ]);
            return redirect()->route('juzgados.index');
        }
    }
}
