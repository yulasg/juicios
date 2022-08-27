<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterno;
use App\Models\Interno;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class InternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.internos')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $internos = Interno::get(); // select("internos.id", "internos.tipo", "internos.nombre");
                return datatables()::of($internos)
                    ->addColumn('botones', 'internos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('internos.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.internos')) { // you can pass an id or slug
            return view('internos.create');
        }
        return redirect()->route('internos.index')->with('success', 'Usuario no autorizado, para crear abogados internos.');
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
        $buscar = DB::table('internos')
            ->where('nombre', $nombre)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado interno, ya existe',
            ]);
        } else {
            $interno = Interno::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado interno, se creó con éxito',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Interno $interno)
    {
        //
        if (Auth::user()->hasPermission('editar.internos')) { // you can pass an id or slug
            return view('internos.edit', compact('interno'));
        }
        return redirect()->route('internos.index')->with('success', 'Usuario no autorizado, para editar abogados internos.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interno $interno)
    {
        //
        $nombre = $request->input('nombre');
        $buscar = DB::table('internos')
            ->where('nombre', $nombre)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado interno, ya existe',
            ]);
        } else {
            $interno->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado interno, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $interno = Interno::onlyTrashed()->find($id);
        $interno->restore();
    }

    public function forceDelete($id)

    {
        //
        $interno = Interno::onlyTrashed()->find($id);
        $interno->forceDelete();
    }


    public function eliminar($id)

    {
        //
        $existe_interno = Juicio::join('internos', 'internos.id', "=", 'juicios.interno_id')
            ->where('juicios.interno_id', '=', $id)
            ->get();
        if (count($existe_interno) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El abogado interno esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Interno::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El abogado interno se eliminó con éxito',
            ]);
            return redirect()->route('internos.index');
        }
    }
}
