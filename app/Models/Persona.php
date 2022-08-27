<?php

namespace App\Models;

use App\Scopes\IdScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable =
    [
        'juicio_id',
        'nombre',
        'persona',
        'numero',
        'rif',
        'email',
        'direccion',
        'celular',
        'habitacion',
        'configuracion_id',
        'usuario'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function juicio()
    {
        return $this->belongsTo('App\Models\Juicio');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function configuracion()
    {
        return $this->belongsTo('App\Models\Configuracion');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function especialidad()
    {
        return  $this->configuracion->belongsTo('App\Models\Especialidad');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $appends =
    [
        'documento',
        'identificador',
        'celular_uno',
        'casa',
        'codigo_casa',
        'numero_casa',
        'codigo_uno',
        'celular_numuno',
        'codigo_casa'
    ];


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getDocumentoAttribute()
    {
        $valorP = strlen($this->attributes['persona']);
        $valorN = strlen($this->attributes['numero']);
        $valorR = strlen($this->attributes['rif']);
        if ($valorP !=  0 &&  $valorN !=  0  &&  $valorR !=  0) {
            return $this->attributes['persona'] . '-' . $this->attributes['numero'] . '-' . $this->attributes['rif'];
        } else {
            if ($valorP !=  0 &&  $valorN !=  0  &&  $valorR ===  0) {
                return $this->attributes['persona'] . '-' . $this->attributes['numero'];
            }
            if ($valorP ===  0 &&  $valorN !=  0  &&  $valorR ===  0) {
                return  $this->attributes['numero'];
            }
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getIdentificadorAttribute()
    {
        return substr($this->attributes['numero'], 0, 8);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    public function getDigitoAttribute()
    {
        $valor10 = strlen($this->attributes['numero']);
        if ($valor10 === 9) {
            $string = $this->attributes['numero'];
            $lengthOfString = strlen($string);
            $lastCharPosition = $lengthOfString - 1;
            $lastChar = $string[$lastCharPosition];
            return $lastChar;
        }
    }
    */
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCelularUnoAttribute()
    {
        $valor1 = strlen($this->attributes['celular']);
        if ($valor1 != 0) {
            return substr($this->attributes['celular'], 0, 4) . '-' . substr($this->attributes['celular'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCasaAttribute()
    {
        $valor3 = strlen($this->attributes['habitacion']);
        if ($valor3 != 0) {
            return substr($this->attributes['habitacion'], 0, 4) . '-' . substr($this->attributes['habitacion'], 4, 7);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCodigoCasaAttribute()
    {
        $valor4 = strlen($this->attributes['habitacion']);
        if ($valor4 != 0) {
            return substr($this->attributes['habitacion'], 0, 4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getNumeroCasaAttribute()
    {
        $valor5 = strlen($this->attributes['habitacion']);
        if ($valor5 != 0) {
            return substr($this->attributes['habitacion'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCodigoUnoAttribute()
    {
        $valor6 = strlen($this->attributes['celular']);
        if ($valor6 != 0) {
            return substr($this->attributes['celular'], 0, 4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCelularNumunoAttribute()
    {
        $valor7 = strlen($this->attributes['celular']);
        if ($valor7 != 0) {
            return substr($this->attributes['celular'], 4, 7);
        }
    }
}
