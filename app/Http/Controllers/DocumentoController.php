<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Auth;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index($id)
    {
        //
        if (Auth::user()->hasPermission('ver.pagares')) { // you can pass an id or slug
            $role = '';
            if (Auth::user()->isGerente()) {
                $role = 'gerente';
            }
            $dataJuicio = $id;
            if (request()->ajax()) {
                $documentos = Documento::where('juicio_id', $dataJuicio)
                    //->select("documentos.*");
                    ->get();
                return datatables()::of($documentos)
                    ->addColumn('botones', 'documentos.botones')
                    ->rawColumns(['botones'])
                    ->make(true);
            }
            return view('documentos.index', compact('dataJuicio', 'role'));
        }
        return redirect()->route('juicios.index', $id)->with('success', 'Usuario no autorizado, para ver pagares.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // 
        if (Auth::user()->hasPermission('crear.pagares')) { // you can pass an id or slug
            $usuario = Auth::user()->nombre_completo;
            $dataJuicio = $id;
            return view('documentos.create', compact('dataJuicio', 'usuario'));
        }
        return redirect()->route('documentos.index', $id)->with('success', 'Usuario no autorizado, para crear pagares.');
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
        $documento = Documento::create($request->all());
        return back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
        if (Auth::user()->hasPermission('editar.pagares')) { // you can pass an id or slug
            $usuario =  Auth::user()->nombre_completo;
            return view('documentos.edit', compact('documento', 'usuario'));
        }
        return redirect()->route('documentos.index', $documento->juicio_id)->with('success', 'Usuario no autorizado, para editar pagares.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
        $documento->update($request->all());
        return redirect()->route('documentos.index', $documento->juicio_id);
    }

    public function restore($id)

    {
        //
        $documento = Documento::onlyTrashed()->find($id);
        $documento->restore();
    }

    public function forceDelete($id)

    {
        //
        $documento = Documento::onlyTrashed()->find($id);
        $documento->forceDelete();
    }

    public function eliminar($id)

    {
        //
        $eliminar = Documento::find($id);
        $eliminar->delete();
        return back();
    }
}
