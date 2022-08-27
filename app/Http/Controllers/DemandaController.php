<?php

namespace App\Http\Controllers;

use App\Models\Demanda;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDemanda;
use App\Models\Juicio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class DemandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.procesos')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $demandas = Demanda::get(); //select("demandas.id", "demandas.descripcion");
                return datatables()::of($demandas)
                    ->addColumn('botones', 'demandas.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('demandas.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.procesos')) { // you can pass an id or slug
            return view('demandas.create');
        }
        return redirect()->route('demandas.index')->with('success', 'Usuario no autorizado, para crear tipo de procesos.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    //public function store(Request $request)
    public function store(Request $request)
    {
        //  
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('demandas')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de proceso, ya existe',
            ]);
        } else {
            $demanda = Demanda::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de proceso, se creó con éxito',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit(Demanda $demanda)
    {
        //
        if (Auth::user()->hasPermission('editar.procesos')) { // you can pass an id or slug
            return view('demandas.edit', compact('demanda'));
        }
        return redirect()->route('demandas.index')->with('success', 'Usuario no autorizado, para editar tipo de procesos.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demanda $demanda)
    {
        // 
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('demandas')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de proceso, ya existe',
            ]);
        } else {
            $demanda->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de proceso, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $demanda = Demanda::onlyTrashed()->find($id);
        $demanda->restore();
    }

    public function forceDelete($id)

    {
        //
        $demanda = Demanda::onlyTrashed()->find($id);
        $demanda->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_demanda = Juicio::join('demandas', 'demandas.id', "=", 'juicios.demanda_id')
            ->where('juicios.demanda_id', '=', $id)
            ->get();
        if (count($existe_demanda) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de proceso esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Demanda::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de proceso se eliminó con éxito',
            ]);
            return redirect()->route('demandas.index');
        }
    }
}
