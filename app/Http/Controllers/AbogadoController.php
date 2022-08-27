<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbogado;
use App\Models\Abogado;
use App\Models\Interno;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Auth;

class AbogadoController extends Controller
{
    public function byAbogados($juicio_id)
    {
        return Abogado::with('interno:id,nombre,tipo')
            ->where('juicio_id', $juicio_id)
            ->orderBy('id', 'desc')
            //->with('jefe:id,nombre,tipo')
            //->where('juicio_id', $juicio_id)
            //->orderBy('id', 'desc')
            ->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)

    { 
        if (Auth::user()->hasPermission('ver.abogados')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            $dataJuicio = $id;
            $internos = Interno::where('tipo', '0')->pluck('nombre', 'id');
            //$jefes = Interno::where('tipo','1')->pluck('nombre', 'id');
            if (request()->ajax()) {
                $abogados = Abogado::with('interno:id,nombre')
                    ->where('juicio_id', $dataJuicio)->orderBy('id', 'desc')->get();
                return datatables()::of($abogados)
                    ->addColumn('botones', 'abogados.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('abogados.index', compact('internos', 'dataJuicio', 'role', 'usuario'));
            //return view('abogados.index', compact('abogados','internos','dataJuicio','jefes'));
        }
        return redirect()->route('juicios.index', $id)->with('success', 'Usuario no autorizado, para ver asignación de abogados.');
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
        $abogado = Abogado::create($request->all());

        $juicio_id = $request->input('juicio_id');
        $interno_id = $request->input('interno_id');

        $juicio = Juicio::find($juicio_id);
        $juicio->interno_id = $interno_id;
        $juicio->save();

        return back();
    }

    public function restore($id)

    {
        //
        $abogado = Abogado::onlyTrashed()->find($id);
        $abogado->restore();
    }

    public function forceDelete($id)

    {
        //
        $abogado = Abogado::onlyTrashed()->find($id);
        $abogado->forceDelete();
    }

    public function eliminar($id)

    {
        $eliminar = Abogado::find($id);
        $eliminar->delete();
        return response()->json([
            'result' => 'success',
            'msj'    => 'El abogado interno se eliminó con éxito',
        ]);
        return back();
    }
}
