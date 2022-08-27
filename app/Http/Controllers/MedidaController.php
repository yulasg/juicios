<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMedida;
use App\Models\Juicio;
use Illuminate\Support\Facades\DB;
use Auth;

class MedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.medidas')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $medidas = Medida::get(); // select("medidas.id", "medidas.descripcion");
                return datatables()::of($medidas)
                    ->addColumn('botones', 'medidas.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('medidas.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.medidas')) { // you can pass an id or slug
            return view('medidas.create');
        }
        return redirect()->route('medidas.index')->with('success', 'Usuario no autorizado, para crear tipos de medidas.');
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
        $buscar = DB::table('medidas')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de medida, ya existe',
            ]);
        } else {
            $medida = Medida::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de medida, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Medida $medida)
    {
        //
        if (Auth::user()->hasPermission('editar.medidas')) { // you can pass an id or slug
            return view('medidas.edit', compact('medida'));
        }
        return redirect()->route('medidas.index')->with('success', 'Usuario no autorizado, para editar tipos de medidas.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medida $medida)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('medidas')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de medida, ya existe',
            ]);
        } else {
            $medida->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de medida, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $medida = Medida::onlyTrashed()->find($id);
        $medida->restore();
    }

    public function forceDelete($id)

    {
        //
        $medida = Medida::onlyTrashed()->find($id);
        $medida->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_medida = Juicio::join('medidas', 'medidas.id', "=", 'juicios.medida_id')
            ->where('juicios.medida_id', '=', $id)
            ->get();
        if (count($existe_medida) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de medida esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Medida::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de medida se eliminó con éxito',
            ]);
            return redirect()->route('medidas.index');
        }
    }
}
