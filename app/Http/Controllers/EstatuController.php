<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstatu;
use App\Models\Estatu;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class EstatuController extends Controller
{

    public function byBuscarEstatu($id)
    {
        //
        return Estatu::where('id', $id)->get();
    }

    public function byEstatu($terminado)
    {
        //
        return Estatu::where('terminado', $terminado)->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.estatus')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $estatus = Estatu::get(); // select("estatus.id", "estatus.terminado", "estatus.descripcion")->orderBy('terminado','desc');
                return datatables()::of($estatus)
                    ->addColumn('botones', 'estatus.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('estatus.index', compact('role'));
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
        //
        if (Auth::user()->hasPermission('crear.estatus')) { // you can pass an id or slug
            return view('estatus.create');
        }
        return redirect()->route('estatus.index')->with('success', 'Usuario no autorizado, para crear estatus.');
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
        $terminado = $request->input('terminado');
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('estatus')
            ->where('terminado', $terminado)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El campo terminado y descripción del estatu, ya existe',
            ]);
        } else {
            $estatu = Estatu::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El campo terminado y descripción del estatu, se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatu $estatu)
    {
        //
        if (Auth::user()->hasPermission('editar.estatus')) { // you can pass an id or slug
            return view('estatus.edit', compact('estatu'));
        }
        return redirect()->route('estatus.index')->with('success', 'Usuario no autorizado, para editar estatus.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estatu $estatu)
    {
        //
        $terminado = $request->input('terminado');
        $descripcion = $request->input('descripcion');

        $buscar = DB::table('estatus')
            ->where('terminado', $terminado)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El campo terminado y descripción del estatu, ya existe',
            ]);
        } else {
            $estatu->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El campo terminado y descripción del estatu, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $estatu = Estatu::onlyTrashed()->find($id);
        $estatu->restore();
    }

    public function forceDelete($id)

    {
        //
        $estatu = Estatu::onlyTrashed()->find($id);
        $estatu->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_estatu = Juicio::join('estatus', 'estatus.id', "=", 'juicios.estatu_id')
            ->where('juicios.estatu_id', '=', $id)
            ->get();
        if (count($existe_estatu) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El estatu esta relacionado con algún juicio',
            ]);
        } else {
            $eliminar = Estatu::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de estatu se eliminó con éxito',
            ]);
            return redirect()->route('estatus.index');
        }
    }
}
