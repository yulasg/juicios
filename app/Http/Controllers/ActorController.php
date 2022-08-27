<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Clases\ReferenciaClass;
use App\Models\Juicio;
use Illuminate\Support\Facades\DB;
use Auth;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $especialidad, $representante)

    {
        $dataJuicio = $id;
        $dataespecialidad = $especialidad;
        $datarepresentante = $representante;
        //return $dataJuicio. ' '. $dataespecialidad . ' '. $datarepresentante;

        $user = Auth::user();
        $role ='';
        if ($user->isGerente()) {
            $role = 'gerente';
        }
        if ($user->hasRole(['abogado', 'gerente', 'consulta'])) {
            if (request()->ajax()) {
                $actores = Actor::with([
                    'juicio:id,representante,admision,asignacion,internacional',
                    'configuracion:id,especialidad_id,descripcion',
                    'configuracion.especialidad:id,internacional,descripcion',
                    'referencia:id,tipo,numero,rif,nombre,direccion,habitacion,celular_principal,celular_secundario,email_principal,email_secundario'
                ])
                    ->where('juicio_id', $dataJuicio)
                    ->get();
                return datatables()::of($actores)
                    //->addColumn('botones', 'actores.botones')
                    //->rawColumns(['botones'])
                    ->make(true);
            }
            return view('actores.index', compact('dataJuicio', 'dataespecialidad', 'datarepresentante','role'));
        } else {
            return redirect()->route('juicios.index', [$id, $especialidad, $representante])->with('success', 'Usuario no autorizado, para ver partes procesales.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $especialidad, $representante)
    {
        //
        $user = Auth::user();
        $usuario = $user->nombre_completo;
        if ($user->hasRole(['abogado'])) {
            $dataJuicio = $id;
            $dataespecialidad = $especialidad;
            $datarepresentante = $representante;
            return view('actores.create', compact('dataJuicio', 'dataespecialidad', 'datarepresentante','usuario'));
        } else {
            return redirect()->route('actores.index', [$id, $especialidad, $representante])->with('success', 'Usuario no autorizado, para crear partes procesales.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->hasRole(['abogado'])) {
            $juicio_id = $request->input('juicio_id');
            $referencia_id = $request->input('referencia_id');
            $configuracion_id = $request->input('configuracion_id');
            $tipo = $request->input('tipo');
            if ($configuracion_id == '') {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'Seleccionar el tipo de parte actora',
                ]);
            }
            if ($configuracion_id == 7 &&  $tipo == 'X') {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'Seleccionar el estatu',
                ]);
            }
            $buscar = DB::table('actores')
                ->where('juicio_id', $juicio_id)
                ->where('referencia_id', $referencia_id)
                ->where('configuracion_id', $configuracion_id)
                ->get();
            if (count($buscar) > 0) {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'Parte actora ya existe para este jucio',
                ]);
            } else {
                $actor = Actor::create($request->all());
                return response()->json([
                    'result' => 'success',
                    'msj'    => 'La relación juicio y parte actora, se creó con exito!',
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        //
        $juicio_id = $actor->juicio_id;
        $buscar = Juicio::where('id', $actor->juicio_id)->get();

        if (count($buscar) > 0) {
            $representante =  $buscar[0]->representante;
        }

        $actorEdit = Actor::with([
            'configuracion:id,especialidad_id,descripcion',
            'configuracion.especialidad:id,internacional,descripcion',
            'referencia:id,tipo,numero,rif,nombre,direccion,habitacion,celular_principal,celular_secundario,email_principal,email_secundario'
        ])
            ->where('id', $actor->id)
            ->get();

        $especialidad_id =   $actorEdit[0]->configuracion->especialidad_id;

        $user = Auth::user();
        $usuario = $user->nombre_completo;
        if ($user->hasRole(['abogado'])) {
            return view('actores.edit', compact('actorEdit', 'representante','usuario'));
        } else {
            return redirect()->route('actores.index', [$juicio_id, $especialidad_id, $representante])->with('success', 'Usuario no autorizado, para editar partes procesales.');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request, Actor $actor)
    {
        //

        $user = Auth::user();
        if ($user->hasRole(['abogado'])) {
            $configuracion_id = $request->input('configuracion_id');
            $tipo = $request->input('tipo');
            if ($configuracion_id == 7 &&  $tipo == 'X') {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'Seleccionar el estatu',
                ]);
            }
            $actor->update($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La parte actoral, se actualizó con éxito',
            ]);
        }
    }



    public function restore($id)

    {
        //
        $actor = Actor::onlyTrashed()->find($id);
        $actor->restore();
    }

    public function forceDelete($id)

    {
        //
        $actor = Actor::onlyTrashed()->find($id);
        $actor->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $eliminar = Actor::find($id);
        $eliminar->delete();
        return back();
    }

    public function buscar(Request $request)
    {
        $tipo = $request->input('tipo');
        $numero = $request->input('numero');
        $rif = $request->input('rif');
        $datos = ReferenciaClass::personal($tipo,  $numero, $rif);
        //return $dato;
        if (count($datos) > 0) {
            return response()->json([
                'result' => 'success',
                $datos,
            ]);
        } else {
            return response()->json([
                'result' => 'warning',
                'msj'    => 'Parte actora, no se encuentra registrada en el maestro',
            ]);
        }
    }
}
