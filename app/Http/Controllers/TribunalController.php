<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTribunal;
use App\Models\Juicio;
use App\Models\Tribunal;
use Illuminate\Http\Request;
use App\Models\Juzgado;
use Illuminate\Support\Facades\DB;
use Auth;

class TribunalController extends Controller
{

    public function byJuzgado($id)
    {
        //
        $juzgado = Juzgado::find($id);
        return $tribunales = $juzgado->tribunales;
        //return Tribunal::where('juzgado_id', $id)->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.tribunales')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $tribunales = Tribunal::with('juzgado:id,descripcion')
                    ->select("tribunales.id", "tribunales.juzgado_id", "tribunales.descripcion")->orderBy('juzgado_id', 'desc');
                return datatables()::of($tribunales)
                    ->addColumn('botones', 'tribunales.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('tribunales.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.tribunales')) { // you can pass an id or slug
            $juzgados = Juzgado::pluck('descripcion', 'id');
            return view('tribunales.create', compact('juzgados'));
        }
        return redirect()->route('tribunales.index')->with('success', 'Usuario no autorizado, para crear tribunales.');
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
        $juzgado_id = $request->input('juzgado_id');
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('tribunales')
            ->where('juzgado_id', $juzgado_id)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El juzgado y tribunal, ya existe',
            ]);
        } else {
            $tribunal = Tribunal::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El juzgado y tribunal, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tribunal $tribunal)
    {
        //
        if (Auth::user()->hasPermission('editar.tribunales')) { // you can pass an id or slug
            $juzgados = Juzgado::pluck('descripcion', 'id');
            return view('tribunales.edit', compact('juzgados', 'tribunal'));
        }
        return redirect()->route('tribunales.index')->with('success', 'Usuario no autorizado, para editar tribunales.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tribunal $tribunal)
    {
        //
        $juzgado_id = $request->input('juzgado_id');
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('tribunales')
            ->where('juzgado_id', $juzgado_id)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El juzgado y tribunal, ya existe',
            ]);
        } else {
            $tribunal->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El juzgado y tribunal, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $tribunal = Tribunal::onlyTrashed()->find($id);
        $tribunal->restore();
    }

    public function forceDelete($id)

    {
        //
        $tribunal = Tribunal::onlyTrashed()->find($id);
        $tribunal->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_tribunal = Juicio::join('tribunales', 'tribunales.id', "=", 'juicios.tribunal_id')
            ->where('juicios.tribunal_id', '=', $id)
            ->get();
        if (count($existe_tribunal) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tribunal esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Tribunal::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tribunal se eliminó con éxito',
            ]);
            return redirect()->route('tribunales.index');
        }
    }
}
