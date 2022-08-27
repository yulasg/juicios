<?php

namespace App\Http\Controllers;

use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class RepresentanteController extends Controller
{
    //
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.representates')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $representante = Representante::get();
                return datatables()::of($representante)
                    ->addColumn('botones', 'representantes.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('representantes.index', compact('role'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }
    public function create()
    {
        //
        if (Auth::user()->hasPermission('crear.representates')) { // you can pass an id or slug
            return view('representantes.create');
        }
        return redirect()->route('representantes.index')->with('success', 'Usuario no autorizado, para crear representantes.');
    }
    public function store(Request $request)
    {
        // 
        $tipo = $request->input('tipo');
        $numero = $request->input('numero');
        $rif = $request->input('rif');
        $buscar = DB::table('representantes')
            ->where('tipo', $tipo)
            ->where('numero', $numero)
            ->where('rif', $rif)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El representante, ya existe',
            ]);
        } else {
            $pretension = Representante::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El representante, se creó con éxito',
            ]);
        }
    }
    public function edit(Representante $representante)
    {
        // 
        if (Auth::user()->hasPermission('editar.representates')) { // you can pass an id or slug
            return view('representantes.edit', compact('representante'));
        }
        return redirect()->route('representantes.index')->with('success', 'Usuario no autorizado, para editar representantes.');
    }
    public function update(Request $request, Representante $representante)
    {
        //
        $representante->update($request->all());
        return response()->json([
            'result' => 'success',
            'msj'    => 'El representante, se actualizó con éxito',
        ]);
    }
    public function restore($id)

    {
        //
        $representante = Representante::onlyTrashed()->find($id);
        $representante->restore();
    }

    public function forceDelete($id)

    {
        //
        $representante = Representante::onlyTrashed()->find($id);
        $representante->forceDelete();
    }
    public function eliminar($id)

    {
        //

        $eliminar = Representante::find($id);
        $eliminar->delete();
        return response()->json([
            'result' => 'success',
            'msj'    => 'El representante, se eliminó con éxito',
        ]);
        return redirect()->route('representantes.index');
    }
}
