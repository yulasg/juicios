<?php

namespace App\Http\Controllers;

use App\Models\Obligacion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObligacion;
use App\Models\Juicio;
use Illuminate\Support\Facades\DB;
use Auth;

class ObligacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.obligaciones')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $obligaciones = Obligacion::get(); // select("obligaciones.id", "obligaciones.descripcion");
                return datatables()::of($obligaciones)
                    ->addColumn('botones', 'obligaciones.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('obligaciones.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.obligaciones')) { // you can pass an id or slug
            return view('obligaciones.create');
        }
        return redirect()->route('obligaciones.index')->with('success', 'Usuario no autorizado, para crear tipo de obligaciones.');
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
        $buscar = DB::table('obligaciones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de obligación, ya existe',
            ]);
        } else {
            $obligacion = Obligacion::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de obligación, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Obligacion $obligacion)
    {
        //
        if (Auth::user()->hasPermission('editar.obligaciones')) { // you can pass an id or slug
            return view('obligaciones.edit', compact('obligacion'));
        }
        return redirect()->route('obligaciones.index')->with('success', 'Usuario no autorizado, para editar tipo de obligaciones.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obligacion $obligacion)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('obligaciones')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de obligación, ya existe',
            ]);
        } else {
            $obligacion->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de obligación, se actualizó con éxito',
            ]);
        }
    }
    public function restore($id)

    {
        //
        $obligacion = Obligacion::onlyTrashed()->find($id);
        $obligacion->restore();
    }

    public function forceDelete($id)

    {
        //
        $obligacion = Obligacion::onlyTrashed()->find($id);
        $obligacion->forceDelete();
    }

    public function eliminar($id)

    {
        //

        $existe_obligacion = Juicio::join('obligaciones', 'obligaciones.id', "=", 'juicios.obligacion_id')
            ->where('juicios.obligacion_id', '=', $id)
            ->get();
        if (count($existe_obligacion) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de obligación esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Obligacion::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de obligación se eliminó con éxito',
            ]);
            return redirect()->route('obligaciones.index');
        }
    }
}
