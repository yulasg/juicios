<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGarantia;
use App\Models\Garantia;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class GarantiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.garantias')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $garantias = Garantia::get(); // select("garantias.id", "garantias.descripcion");
                return datatables()::of($garantias)
                    ->addColumn('botones', 'garantias.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('garantias.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.garantias')) { // you can pass an id or slug
            return view('garantias.create');
        }
        return redirect()->route('garantias.index')->with('success', 'Usuario no autorizado, para crear tipo de garantías.');
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
        $buscar = DB::table('garantias')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de garantía, ya existe',
            ]);
        } else {
            $garantia = Garantia::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de garantía, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Garantia $garantia)
    {
        //
        if (Auth::user()->hasPermission('editar.garantias')) { // you can pass an id or slug
            return view('garantias.edit', compact('garantia'));
        }
        return redirect()->route('garantias.index')->with('success', 'Usuario no autorizado, para editar tipo de garantías.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garantia $garantia)
    {
        //
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('garantias')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de garantía, ya existe',
            ]);
        } else {
            $garantia->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de garantía, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $garantia = Garantia::onlyTrashed()->find($id);
        $garantia->restore();
    }

    public function forceDelete($id)

    {
        //
        $garantia = Garantia::onlyTrashed()->find($id);
        $garantia->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_garantia = Juicio::join('garantias', 'garantias.id', "=", 'juicios.garantia_id')
            ->where('juicios.garantia_id', '=', $id)
            ->get();
        if (count($existe_garantia) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de garantía esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Garantia::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de garantía se eliminó con éxito',
            ]);
            return redirect()->route('garantias.index');
        }
    }
}
