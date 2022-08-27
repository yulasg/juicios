<?php

namespace App\Http\Controllers;

use App\Models\Juicio;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Repositories\JuicioRepositorio;
use Illuminate\Support\Facades\DB;
use Auth;


class PersonaController extends Controller
{

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $especialidad, $representante)
    {


        //return $dataJuicio. ' '. $dataespecialidad . ' '. $datarepresentante;
        /*
        $personas = Persona::with([
            'juicio:id,representante,admision,asignacion,internacional',
            'configuracion:id,especialidad_id,descripcion',
            'configuracion.especialidad:id,internacional,descripcion'
        ])
            ->where('juicio_id', $dataJuicio)
            ->get();
        return   $personas;
        */

      

        if (Auth::user()->hasPermission('ver.personas')) { // you can pass an id or slug
            $dataJuicio = $id;
            $dataespecialidad = $especialidad;
            $datarepresentante = $representante;
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            if (request()->ajax()) {
                $personas = Persona::with([
                    'juicio:id,representante,admision,asignacion,internacional',
                    'configuracion:id,especialidad_id,descripcion',
                    'configuracion.especialidad:id,internacional,descripcion'
                ])
                    ->where('juicio_id', $dataJuicio)
                    ->get();
                return datatables()::of($personas)
                    //->addColumn('botones', 'personas.botones')
                    //->rawColumns(['botones'])
                    ->make(true);
            }
            return view('personas.index', compact('dataJuicio', 'dataespecialidad', 'datarepresentante', 'role'));
        }
        return redirect()->route('juicios.index', [$id, $especialidad, $representante])->with('success', 'Usuario no autorizado, para ver partes procesales.');
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $especialidad, $representante)
    {
        //
        if (Auth::user()->hasPermission('crear.personas')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $dataJuicio = $id;
            $dataespecialidad = $especialidad;
            $datarepresentante = $representante;
            return view('personas.create', compact('dataJuicio', 'dataespecialidad', 'datarepresentante', 'usuario'));
        }
        return redirect()->route('personas.index', [$id, $especialidad, $representante])->with('success', 'Usuario no autorizado, para crear partes procesales.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        //

        $juicio_id = $request->input('juicio_id');
        $persona = $request->input('persona');
        $numero = $request->input('numero');
        $rif = $request->input('rif');
        if ($persona  != '' ||  $numero  != '' || $rif  != '') {
            $buscar = DB::table('personas')
                ->where('juicio_id', $juicio_id)
                ->where('persona', $persona)
                ->where('numero', $numero)
                ->where('rif', $rif)
                ->whereNull('deleted_at')
                ->get();
            if (count($buscar) > 0) {
                return response()->json([
                    'result' => 'warning',
                    'msj'    => 'La parte acotra, ya existe para ete juicio',
                ]);
            } else {
                $persona = Persona::create($request->all());
                return response()->json([
                    'result' => 'success',
                    'msj'    => 'La parte acotra, se creó con éxito',
                ]);
            }
        } else {
            $persona = Persona::create($request->all());
            return response()->json([
                'result' => 'success',
                'msj'    => 'La parte acotra, se creó con éxito',
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //    
        $juicio_id = $persona->juicio_id;
        $buscar = Juicio::where('id', $persona->juicio_id)->get();
        if (count($buscar) > 0) {
            $representante =  $buscar[0]->representante;
        }

        $especialidad = Persona::with([
            'configuracion:id,especialidad_id,descripcion'
        ])
            ->where('id', $persona->id)
            ->get();
        $especialidad_id =   $especialidad[0]->configuracion->especialidad_id;

        if (Auth::user()->hasPermission('editar.personas')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            return view('personas.edit', compact('especialidad', 'persona', 'representante', 'usuario'));
        }
        return redirect()->route('personas.index', [$juicio_id, $especialidad_id, $representante])->with('success', 'Usuario no autorizado, para editar partes procesales.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonaRequest  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //

        $persona->update($request->all());
        return response()->json([
            'result' => 'success',
            'msj'    => 'La parte actoral, se actualizó con éxito',
        ]);
        //return $request;
        /*
        $persona_id = $request->input('persona_id');
        $persona = Persona::find($persona_id);
        $persona->nombre = $request->input('persona');
        $persona->save();
        return back();
        */

        //$persona->update($request->all());
        //return redirect()->route('personas.edit', $persona)->with('info', 'El demandado se actualizó con éxito');
        //return redirect()->route('personas.index', $persona)->with('info','El demandado se actualizó con éxito');
    }

    public function restore($id)

    {
        //
        $persona = Persona::onlyTrashed()->find($id);
        $persona->restore();
    }

    public function forceDelete($id)

    {
        //
        $persona = Persona::onlyTrashed()->find($id);
        $persona->forceDelete();
    }


    public function eliminar($id)

    {
        //

        $eliminar = Persona::find($id);
        $eliminar->delete();
        return back();
    }


    public function consulta()
    {
        if (Auth::user()->hasPermission('ver.personas')) { // you can pass an id or slug
            //$mdoleoPersonas = JuicioRepositorio::getTodosPersonas();
            //return  count( $mdoleoPersonas) ;
            if (request()->ajax()) {
                $mdoleoPersonas = JuicioRepositorio::getTodosPersonas();
                return datatables()::of($mdoleoPersonas)
                    ->toJson();
            }
            return view('personas.consulta');
            //return view('personas.consulta', compact('modeloPersonas'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }
}
