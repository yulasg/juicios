<?php

namespace App\Http\Controllers;

use App\Models\Juicio;
use App\Models\Relacion;
use App\Repositories\RelacionRepositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class RelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        if (Auth::user()->hasPermission('ver.relacionar')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }

            $dataJuicio = $id;
            /*
            $relaciones1 = RelacionRepositorio::getRelacionBD1($dataJuicio);
            $relaciones2 = RelacionRepositorio::getRelacionBD2($dataJuicio);
            */
            $relaciones1 = RelacionRepositorio::getRelacionModelo1($dataJuicio);
            $relaciones2 = RelacionRepositorio::getRelacionModelo2($dataJuicio);
            return view('relaciones.index', compact('dataJuicio', 'relaciones1', 'relaciones2', 'usuario', 'role'));
        }
        return redirect()->route('juicios.index', $id)->with('success', 'Usuario no autorizado, para ver relación de juicios.');


        /*
        if ($user->hasRole(['gerente', 'consulta', 'abogado'])) {
            if ($user->hasPermission('64')) { // you can pass an id or slug
                //
                $dataJuicio = $id;
                
                $relaciones1 = RelacionRepositorio::getRelacionBD1($dataJuicio);
                $relaciones2 = RelacionRepositorio::getRelacionBD2($dataJuicio);
                
                $relaciones1 = RelacionRepositorio::getRelacionModelo1($dataJuicio);
                $relaciones2 = RelacionRepositorio::getRelacionModelo2($dataJuicio);
                return view('relaciones.index', compact('dataJuicio', 'relaciones1', 'relaciones2', 'usuario', 'role'));
            } else {
                return redirect()->route('juicios.index', $id)->with('success', 'Usuario no autorizado, para ver relación de juicios.');
            }
        }
        */



        /*
        if ($user->hasRole(['gerente', 'consulta', 'abogado'])) {
            $dataJuicio = $id;
            
            $relaciones1 = RelacionRepositorio::getRelacionBD1($dataJuicio);
            $relaciones2 = RelacionRepositorio::getRelacionBD2($dataJuicio);
            
            $relaciones1 = RelacionRepositorio::getRelacionModelo1($dataJuicio);
            $relaciones2 = RelacionRepositorio::getRelacionModelo2($dataJuicio);
            return view('relaciones.index', compact('dataJuicio', 'relaciones1', 'relaciones2', 'usuario', 'role'));
        } else {
            return redirect()->route('juicios.index', $id)->with('success', 'Usuario no autorizado, para ver relación de juicios.');
        }
        */
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // que vas a relacionar 1,2,3,4
        $njuicio = $request->input('juicio_id');

        //en el que estas parado 40
        $njuicio1 = $request->input('juicio1_id');



        if ($njuicio1 == $njuicio) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'No se puede relacionar el mismo juicio',
            ]);
        }

        $juicio = Juicio::where('id',  $njuicio)->get();
        if (count($juicio) > 0) {
            $relacionN = Relacion::where('juicio_id',  $njuicio1)
                ->where('juicio1_id',   $njuicio)
                ->whereNull('relaciones.deleted_at')
                ->select("relaciones.*")->get();
            if (count($relacionN) > 0) {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'Juicio  ya esta relacionado',
                ]);
            } else {
                $relacionN = Relacion::where('juicio1_id',  $njuicio1)
                    ->where('juicio_id',   $njuicio)
                    ->whereNull('relaciones.deleted_at')
                    ->select("relaciones.*")->get();
                if (count($relacionN) > 0) {
                    return response()->json([
                        'result' => 'warning',
                        'msj'    => 'Juicio ya esta relacionado',
                    ]);
                } else {
                    $relacion = Relacion::create($request->all());
                    return response()->json([
                        'result' => 'success',
                        'msj'    => 'La relación, se creó con exito!',
                    ]);
                }
            }
        } else {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'Juicio no existe en la base de datos',
            ]);
        }
    }





    public function restore($id)

    {
        //
        $relacion = Relacion::onlyTrashed()->find($id);
        $relacion->restore();
    }

    public function forceDelete($id)

    {
        //
        $relacion = Relacion::onlyTrashed()->find($id);
        $relacion->forceDelete();
    }


    public function eliminar($id)

    {
        //
        $eliminar = Relacion::find($id);
        $eliminar->delete();
        return back();
    }
}
