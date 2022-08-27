<?php

namespace App\Http\Controllers;

use Auth;


class UserController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        //$user = Auth::user()->roles[0]->description;
        // $user = Auth::user()->roles;
        //return     $user;

        $user = Auth::user();
        $usuario = $user->nombre_completo;
        $rol = Auth::user()->roles[0]->description;

        //$data = Auth::user()->getPermissions();
        //$data = Auth::user()->hasPermission('71');
        //return  $data;

        /*
        $permiso = Auth::user()->roles[0]->pivot->role_id;
        $data = Auth::user()->getPermissions();
        $data = Auth::user()->hasPermission('8', true);

    
        if ($user->isAbogado()) {
            echo "si soy abogado";
        }else{
            if ($user->isGerente()) {
                echo "si soy gerente";
            }else{
                if ($user->isConsulta()) {
                    echo "si soy consulta";
                }else{
                    echo "si soy mantenimiento";
                }
            }
        }
        */


        if ($user->isAdmin()) {
            return view('pages.admin.home');
        }
        //return view('pages.user.home');
        return view('inicio', compact('usuario'));
    }
}
