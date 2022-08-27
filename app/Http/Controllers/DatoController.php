<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\Juicio;
use Illuminate\Http\Request;
//use Carbon\Carbon;
//use DateTimeInterface;
use Auth;

class DatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $dataJuicio = $id;

        //$dataJuicio = Juicio::latest('id')->first();

        $JuicioDato = Juicio::find($dataJuicio);

        $usuario = Auth::user()->nombre_completo;
        $role = '';
        if (Auth::user()->isAbogado()) {
            $role = 'abogado';
        }
        
        if (Auth::user()->hasRole(['abogado', 'gerente', 'consulta'])) {
            if (isset($JuicioDato->dato)) {
                //return $JuicioDato->dato->juicio_id;
                return view('datos.edit', compact('JuicioDato', 'usuario','role'));
            } else {

                return view('datos.create', compact('dataJuicio', 'usuario','role'));
            }
        } else {
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //return $request->all();
        $dato = Dato::create($request->all());
        //return back();
        return redirect()->route('datos.edit', $dato)->with('info', 'Los datos se crearón con éxito');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dato $dato)
    {
        //

        $dataJuicio = Juicio::latest('id')->first();
        $JuicioDato = Juicio::find($dataJuicio->id);

        return $JuicioDato->dato->juicio_id;
        return view('datos.edit', compact('JuicioDato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dato $dato)
    {
        //return  $request;
        $dato->update($request->all());
        return back();
        //return redirect()->route('datos.index', $dato)->with('info', 'La información se actualizó con éxito');

    }
}
