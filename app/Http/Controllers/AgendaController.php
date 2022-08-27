<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$agendas = Agenda::All();
        //return   $agendas ;
        //
        //$fecha= Carbon::now()->format('Y-m-d');
        //$fecha = Carbon::now();
        if (Auth::user()->hasPermission('ver.agendas')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            return view('agendas.index',compact('role'));
        }
        return redirect()->route('inicio')->with('success', 'Usuario no autorizado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
        if (Auth::user()->hasPermission('editar.agendas')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            return view('agendas.edit', compact('agenda', 'usuario'));
        }
        return redirect()->route('agendas.index')->with('success', 'Usuario no autorizado, para editar agenda.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
        $agenda->update($request->all());
        return redirect()->route('agendas.index');
    }


    public function restore($id)

    {
        //
        $agenda = Agenda::onlyTrashed()->find($id);
        $agenda->restore();
    }

    public function forceDelete($id)

    {
        //
        $agenda = Agenda::onlyTrashed()->find($id);
        $agenda->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $eliminar = Agenda::find($id);
        $eliminar->delete();
        return back();
    }

    public function buscar(Request $request)
    {
        $agendas = Agenda::select('agendas.*');
        if (request()->ajax()) {
            return DataTables()::of($agendas)
                ->filter(function ($query) use ($request) {
                    if (!empty($request->get('inicio'))) {
                        $query->where(DB::raw("TO_CHAR(inicio,'YYYY-MM-DD')"),  $request->get('inicio'));
                    }
                })
                ->addColumn('botones', 'agendas.botones')
                ->rawColumns(['botones'])
                ->make(true);
        }
    }
}
