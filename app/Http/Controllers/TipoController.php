<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class TipoController extends Controller
{
    //
    public function index()
    {
        // 
        if (Auth::user()->hasPermission('ver.tipos')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $demandas = Tipo::get();
                return datatables()::of($demandas)
                    ->addColumn('botones', 'tipos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('tipos.index', compact('role'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }

    public function create()
    {
        //
        if (Auth::user()->hasPermission('crear.tipos')) { // you can pass an id or slug
            return view('tipos.create');
        }
        return redirect()->route('tipos.index')->with('success', 'Usuario no autorizado, para crear tipo de documentos.');
    }
    public function store(Request $request)
    {
        //  
        $descripcion = $request->input('descripcion');
        $buscar = DB::table('tipos')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de documento, ya existe',
            ]);
        } else {
            $tipo = Tipo::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de documento, se creó con éxito',
            ]);
        }
    }
    public function edit(Tipo $tipo)
    {
        //
        if (Auth::user()->hasPermission('editar.tipos')) { // you can pass an id or slug
            return view('tipos.edit', compact('tipo'));
        }
        return redirect()->route('tipos.index')->with('success', 'Usuario no autorizado, para editar tipo de documentos.');
    }

    public function update(Request $request, Tipo $tipo)
    {
        // 

        $descripcion = $request->input('descripcion');
        $buscar = DB::table('tipos')
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de documento, ya existe',
            ]);
        } else {
            $tipo->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de documento, se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $tipo = Tipo::onlyTrashed()->find($id);
        $tipo->restore();
    }

    public function forceDelete($id)

    {
        //
        $tipo = Tipo::onlyTrashed()->find($id);
        $tipo->forceDelete();
    }

    public function eliminar($id)

    {
        //

        $eliminar = Tipo::find($id);
        $eliminar->delete();
        return response()->json([
            'result' => 'success',
            'msj'    => 'El tipo de documento se eliminó con éxito',
        ]);
        return redirect()->route('tipos.index');
    }
}
