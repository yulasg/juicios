<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Juicio;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Auth;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        if (Auth::user()->hasPermission('ver.actividades')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            $dataJuicio = $id;
            if (request()->ajax()) {
                $movimientos = Movimiento::where('juicio_id', $dataJuicio)
                    ->orderBy('fecha', 'desc')
                    ->get();
                return datatables()::of($movimientos)
                    ->addColumn('botones', 'movimientos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('movimientos.index', compact('dataJuicio', 'role'));
        }
        return redirect()->route('juicios.index')->with('success', 'Usuario no autorizado, para ver actividades del juicio.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        if (Auth::user()->hasPermission('crear.actividades')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $dataJuicio = $id;
            return view('movimientos.create', compact('dataJuicio', 'usuario'));
        }
        return redirect()->route('movimientos.index', $id)->with('success', 'Usuario no autorizado, para crear actividades del juicio.');
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

        $movimiento = Movimiento::create($request->all());

        $juicio_id = $request->input('juicio_id');

        $usuario = $request->input('usuario');

        $destino = $request->input('destino');
        $asunto = $request->input('asunto');
        $referencia1 = $request->input('referencia1');
        $referencia2 = $request->input('referencia2');
        $inicio = $request->input('inicio');

        $ultimoMovimiento = Movimiento::select("movimientos.id", "movimientos.juicio_id", "movimientos.fecha")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->first();

        $juicio = Juicio::find($ultimoMovimiento->juicio_id);
        $juicio->movimiento = $ultimoMovimiento->fecha_movimiento;
        $juicio->save();

        $agenda = new Agenda();
        $agenda->inicio = $inicio;
        $agenda->destino = $destino;
        $agenda->asunto = $asunto;
        $agenda->referencia1 = $referencia1;
        $agenda->referencia2 = $referencia2;
        $agenda->usuario = $usuario;
        $agenda->save();

        return back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimiento $movimiento)
    {
        //
        if (Auth::user()->hasPermission('editar.actividades')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            return view('movimientos.edit', compact('movimiento', 'usuario'));
        }
        return redirect()->route('movimientos.index', $movimiento->juicio_id)->with('success', 'Usuario no autorizado, para editar actividades del juicio.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        //
        $movimiento->update($request->all());
        return redirect()->route('movimientos.index', $movimiento->juicio_id);
        //return back();
    }

    public function restore($id)

    {
        //
        $movimiento = Movimiento::onlyTrashed()->find($id);
        $movimiento->restore();
    }

    public function forceDelete($id)

    {
        //
        $movimiento = Movimiento::onlyTrashed()->find($id);
        $movimiento->forceDelete();
    }

    public function eliminar($id)

    {
        //

        $eliminar = Movimiento::find($id);

        $juicio_id = $eliminar->juicio_id;

        $juicio = Juicio::find($juicio_id);
        $juicio->movimiento = null;
        $juicio->save();

        $eliminar->delete();


        $ultimoMovimiento = Movimiento::select("movimientos.id", "movimientos.juicio_id", "movimientos.fecha")
            ->orderBy('fecha', 'desc')
            ->where('juicio_id', $juicio_id)
            ->first();

        if (empty($ultimoMovimiento->id)) {
        } else {
            $juicio = Juicio::find($ultimoMovimiento->juicio_id);
            $juicio->movimiento = $ultimoMovimiento->fecha_movimiento;
            $juicio->save();
        }

        return back();
        //return redirect()->route('movimientos.index')->with('info', 'La actividad se eliminó con éxito');
    }
}
