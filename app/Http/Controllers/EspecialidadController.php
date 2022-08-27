<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEspecialidad;
use App\Models\Especialidad;
use App\Models\Juicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class EspecialidadController extends Controller
{

    public function byInternacional($id)
    {
        //
        $especialidad = DB::table('especialidades')
            ->where('internacional', $id)
            ->get();
        return $especialidad;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->hasPermission('ver.especialidades')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isEspecialidades()) {
                $role = 'especialidades';
            }
            if (request()->ajax()) {
                $especialidades = Especialidad::get(); // select("especialidades.id", "especialidades.internacional", "especialidades.descripcion")->orderBy('internacional', 'desc');
                return datatables()::of($especialidades)
                    ->addColumn('botones', 'especialidades.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('especialidades.index', compact('role'));
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
        if (Auth::user()->hasPermission('crear.especialidades')) { // you can pass an id or slug
            return view('especialidades.create');
        }
        return redirect()->route('especialidades.index')->with('success', 'Usuario no autorizado, para crear especialidades.');
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
        $internacional = $request->input('internacional');
        $descripcion = $request->input('descripcion');

        $buscar = DB::table('especialidades')
            ->where('internacional', $internacional)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de juicio y la especialidad, ya existe',
            ]);
        } else {
            $especialidad = Especialidad::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de juicio y la especialidad se creó con éxito',
            ]);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidad $especialidad)
    {
        //
        if (Auth::user()->hasPermission('crear.especialidades')) { // you can pass an id or slug
            return view('especialidades.edit', compact('especialidad'));
        }
        return redirect()->route('especialidades.index')->with('success', 'Usuario no autorizado, para editar especialidades.');
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        // 
        $internacional = $request->input('internacional');
        $descripcion = $request->input('descripcion');

        $buscar = DB::table('especialidades')
            ->where('internacional', $internacional)
            ->where('descripcion', $descripcion)
            ->get();
        if (count($buscar) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'El tipo de juicio y la especialidad, ya existe',
            ]);
        } else {
            $especialidad->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'El tipo de juicio y la especialidad se actualizó con éxito',
            ]);
        }
    }

    public function restore($id)

    {
        //
        $especialidad = Especialidad::onlyTrashed()->find($id);
        $especialidad->restore();
    }

    public function forceDelete($id)

    {
        //
        $especialidad = Especialidad::onlyTrashed()->find($id);
        $especialidad->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $existe_especialidad = Juicio::join('especialidades', 'especialidades.id', "=", 'juicios.especialidad_id')
            ->where('juicios.especialidad_id', '=', $id)
            ->get();
        if (count($existe_especialidad) > 0) {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'La especialidad esta relacionada con algún juicio',
            ]);
        } else {
            $eliminar = Especialidad::find($id);
            $eliminar->delete();
            return response()->json([
                'result' => 'success',
                'msj'    => 'La especialidad se eliminó con éxito',
            ]);
            return redirect()->route('especialidades.index');
        }
    }
}
