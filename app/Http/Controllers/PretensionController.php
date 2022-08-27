<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePretension;
use App\Models\Juicio;
use App\Models\Pretension;
use Illuminate\Support\Facades\DB;
use Auth;

class PretensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        if (Auth::user()->hasPermission('ver.pretensiones')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $pretensiones = Pretension::get(); // select("pretensiones.id", "pretensiones.descripcion");
                return datatables()::of($pretensiones)
                    ->addColumn('botones', 'pretensiones.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('pretensiones.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.pretensiones')) { // you can pass an id or slug
            return view('pretensiones.create');
        }
        return redirect()->route('pretensiones.index')->with('success', 'Usuario no autorizado, para crear tipo de pretensiones.');
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
        $buscar = DB::table('pretensiones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de pretensión, ya existe',
            ]);
        } else {
            $pretension = Pretension::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de pretensión, se creó con éxito',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pretension $pretension)
    {
        //
        if (Auth::user()->hasPermission('editar.pretensiones')) { // you can pass an id or slug
            return view('pretensiones.edit', compact('pretension'));
        }
        return redirect()->route('pretensiones.index')->with('success', 'Usuario no autorizado, para editar tipo de pretensiones.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pretension $pretension)
    {
        //

        $descripcion = $request->input('descripcion');
        $buscar = DB::table('pretensiones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de pretensión, ya existe',
            ]);
        } else {
            $pretension->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de pretensión, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $pretension = Pretension::onlyTrashed()->find($id);
        $pretension->restore();
    }

    public function forceDelete($id)

    {
        //
        $pretension = Pretension::onlyTrashed()->find($id);
        $pretension->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_pretension = Juicio::join('pretensiones', 'pretensiones.id', "=", 'juicios.pretension_id')
            ->where('juicios.pretension_id', '=', $id)
            ->get();
        if (count($existe_pretension) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de pretensión esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Pretension::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de pretensión se eliminó con éxito',
            ]);
            return redirect()->route('pretensiones.index');
        }
    }
}
