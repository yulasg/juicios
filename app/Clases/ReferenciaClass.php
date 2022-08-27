<?php

namespace App\Clases;

use App\Http\Controllers\Controller;
use App\Models\Referencia;

class ReferenciaClass extends Controller
{
    protected $tipo;
   // protected $numerox;
    protected $numero;
    protected $rif;

    static public function personal($tipo,  $numero, $rif)
    {
        if (strlen($numero) < 8) {
            $length = 8;
            $string = substr(str_repeat(0, $length) . $numero, -$length);
            $numero = $string;
        } else {
            $numero = $numero;
        }
        $datos = Referencia::where('tipo', $tipo)
            ->where('numero', $numero)
            ->where('rif', $rif)
            ->get();
        return $datos;
    }
}
