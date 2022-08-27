<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Estatu;
use App\Models\Externo;
use App\Models\Garantia;
use App\Models\Interno;
use App\Models\Juicio;
use App\Models\Juzgado;
use App\Models\Medida;
use App\Models\Obligacion;
use App\Models\Pretension;
use App\Models\Procedencia;
use App\Models\Tribunal;
use App\Models\Ubicacion;
use App\Models\Demanda;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Repositories\JuicioRepositorio;
use Auth;
use Illuminate\Support\Facades\Cache;



class JuicioController extends Controller
{
    //

    public function index()

    {
    
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            //if ($user->hasRole(['abogado', 'gerente', 'consulta'])) {
            if (request()->ajax()) {
                $juicios = JuicioRepositorio::getTodosJuicios();
                return datatables()::of($juicios)
                    ->toJson();
            }
            return view('juicios.index', compact('role'));
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

        //return Auth::user()->hasPermission('crear.juicios');
        
        if (Auth::user()->hasPermission('crear.juicios')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $juzgados = Juzgado::pluck('descripcion', 'id');
            $tribunales = Tribunal::pluck('descripcion', 'id');
            $garantias = Garantia::pluck('descripcion', 'id');
            $medidas = Medida::pluck('descripcion', 'id');
            $pretensiones = Pretension::pluck('descripcion', 'id');
            $internos = Interno::pluck('nombre', 'id');
            $externos = Externo::pluck('nombre', 'id');
            $estados = Estado::pluck('descripcion', 'id');
            $obligaciones = Obligacion::pluck('descripcion', 'id');
            $demandas = Demanda::pluck('descripcion', 'id');
            $procedencias = Procedencia::pluck('descripcion', 'id');
            $ubicaciones = Ubicacion::pluck('descripcion', 'id');
            $especialidades = Especialidad::pluck('descripcion', 'id');
            return view('juicios.create', compact('demandas', 'procedencias', 'ubicaciones', 'juzgados', 'tribunales', 'garantias', 'medidas', 'pretensiones', 'internos', 'externos', 'estados', 'obligaciones', 'especialidades', 'usuario'));
        }
        return redirect()->route('juicios.index')->with('success', 'Usuario no autorizado, para crear juicio.');
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
        $juicio = Juicio::create($request->all());
        Cache::flush();
        return response()->json([
            'juicio_id' =>   $juicio->id,
            'especialidad_id' =>  $juicio->especialidad_id,
            'representante' =>  $juicio->representante
        ]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Juicio $juicio)
    {
        //
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            $juicioDato =  Juicio::where('id', $juicio->id)
                ->with([
                    'dato:id,juicio_id,tasa,capital,monto,mora,interes,observacion,juez',
                    'tribunal:id,descripcion,juzgado_id',
                    'tribunal.juzgado:id,descripcion',
                    'garantia:id,descripcion',
                    'procedencia:id,descripcion',
                    'ubicacion:id,descripcion',
                    'estatu:id,descripcion,terminado',
                    'interno:id,nombre',
                    'externo:id,nombre',
                    'obligacion:id,descripcion',
                    'estado:id,descripcion',
                    'demanda:id,descripcion',
                    'pretension:id,descripcion',
                    'medida:id,descripcion',
                    'especialidad:id,descripcion',
                    'personas',
                    'personas.configuracion',
                    'actores:id,juicio_id,configuracion_id,referencia_id,tipo',
                    'actores.configuracion',
                    'actores.referencia',
                    'documentos'
                ])
                ->withUltimoSeguimiento()
                ->with('ultimoSeguimiento.actividad:id,descripcion')
                ->WithUltimoMovimiento()
                ->get();
            return view('juicios.show', compact('juicioDato'));
        }
        return redirect()->route('juicios.index')->with('success', 'Usuario no autorizado, para ver juicio.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Juicio $juicio)
    {
        //
        if (Auth::user()->hasPermission('editar.juicios')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $juzgados = Juzgado::pluck('descripcion', 'id');
            $X = Tribunal::where('id', $juicio->tribunal_id)->get();
            $tribunales = Tribunal::where('juzgado_id', $X[0]->juzgado_id)->pluck('descripcion', 'id');
            $garantias = Garantia::pluck('descripcion', 'id');
            $medidas = Medida::pluck('descripcion', 'id');
            $pretensiones = Pretension::pluck('descripcion', 'id');
            $internos = Interno::pluck('nombre', 'id');
            $externos = Externo::pluck('nombre', 'id');
            $estados = Estado::pluck('descripcion', 'id');
            $obligaciones = Obligacion::pluck('descripcion', 'id');
            $demandas = Demanda::pluck('descripcion', 'id');
            $procedencias = Procedencia::pluck('descripcion', 'id');
            $ubicaciones = Ubicacion::pluck('descripcion', 'id');
            $estatuBuscar = Estatu::where('id', $juicio->estatu_id)->get();
            $terminado = 'N';
            if ($estatuBuscar[0]->terminado == 'Si') {
                $terminado = 'S';
            }
            $estatus = Estatu::where('terminado',  $terminado)->pluck('descripcion', 'id');
            $especialidades = Especialidad::where('internacional', $juicio->internacional)->pluck('descripcion', 'id');
            return view('juicios.edit', compact('juicio', 'estatus', 'demandas', 'procedencias', 'ubicaciones', 'juzgados', 'tribunales', 'garantias', 'medidas', 'pretensiones', 'internos', 'externos', 'estados', 'obligaciones', 'especialidades', 'usuario'));
        }
        return redirect()->route('juicios.index')->with('success', 'Usuario no autorizado, para editar juicio.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Juicio $juicio)
    {
        $juicio->update($request->all());
        Cache::flush();
        /*
        return response()->json([
            'result' => 'success',
            'msj'    => 'El registro se actualizó con exito!',
        ]);
        */
        return back();
    }


    public function restore($id)

    {
        //
        $juicio = Juicio::onlyTrashed()->find($id);
        $juicio->restore();
    }

    public function forceDelete($id)

    {
        //
        $juicio = Juicio::onlyTrashed()->find($id);
        $juicio->forceDelete();
    }


    public function eliminar($id)

    {
        //
        $eliminar = Juicio::find($id);
        $eliminar->delete();
        Cache::flush();
        return redirect()->route('juicios.index')->with('info', 'El juicio se eliminó con éxito');
    }

    public function consultaseguimiento()
    {
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            if (request()->ajax()) {
                $juicios = JuicioRepositorio::getJuiciosUltimoSeguimiento();
                return datatables()::of($juicios)
                    ->toJson();
            }
            return view('juicios.consultaseguimiento');
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }

    public function consultajuicio()
    {
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            $internos = Interno::pluck('nombre', 'id');
            $externos = Externo::pluck('nombre', 'id');
            if (request()->ajax()) {
                $juicios = JuicioRepositorio::getJuiciosEspecialidadFogade();
                return datatables()::of($juicios)
                    ->toJson();
                    //->make(true);
            }
            return view('juicios.consultajuicio', compact('internos', 'externos'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
        
    }

    public function consultajuicioespecialidad()
    {
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            if (request()->ajax()) {
                $juicios = JuicioRepositorio::getJuiciosEspecialidades();
                return datatables()::of($juicios)
                    ->toJson();
                    //->make(true);
            }
            return view('juicios.consultajuicioespecialidad');
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
        
    }

    public function consultamovimiento()
    {
        if (Auth::user()->hasPermission('ver.juicios')) { // you can pass an id or slug
            if (request()->ajax()) {
                $juicios = JuicioRepositorio::getJuiciosUltimoMovimiento();
                return datatables()::of($juicios)
                    ->toJson();
            }
            return view('juicios.consultamovimiento');
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }
}
