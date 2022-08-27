<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExterno;
use App\Models\Externo;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class ExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.externos')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $externos = Externo::get();   // select("externos.id", "externos.nombre");
                return datatables()::of($externos)
                    ->addColumn('botones', 'externos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('externos.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.externos')) { // you can pass an id or slug
            return view('externos.create');
        }
        return redirect()->route('externos.index')->with('success', 'Usuario no autorizado, para crear abogados externos.');
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
        $nombre = $request->input('nombre');
        $buscar = DB::table('externos')
            ->where('nombre', $nombre)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado externo, ya existe',
            ]);
        } else {
            $externo = Externo::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado externo, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Externo $externo)
    {
        //
        if (Auth::user()->hasPermission('editar.externos')) { // you can pass an id or slug
            return view('externos.edit', compact('externo'));
        }
        return redirect()->route('externos.index')->with('success', 'Usuario no autorizado, para editar abogados externos.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Externo $externo)
    {
        //
        $nombre = $request->input('nombre');
        $buscar = DB::table('externos')
            ->where('nombre', $nombre)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado externo, ya existe',
            ]);
        } else {
            $externo->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado externo, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $externo = Externo::onlyTrashed()->find($id);
        $externo->restore();
    }

    public function forceDelete($id)

    {
        //
        $externo = Externo::onlyTrashed()->find($id);
        $externo->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_externo = Juicio::join('externos', 'externos.id', "=", 'juicios.externo_id')
            ->where('juicios.externo_id', '=', $id)
            ->get();
        if (count($existe_externo) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado externo esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Externo::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado externo se eliminó con éxito',
            ]);
            return redirect()->route('externos.index');
        }
    }
}
