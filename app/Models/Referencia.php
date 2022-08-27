<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referencia extends Model
{ 
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable =
    [
        'tipo',
        'numero',
        'rif',
        'nombre',
        'email_principal',
        'email_secundario',
        'direccion',
        'celular_principal',
        'celular_secundario',
        'habitacion'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $appends =
    [
        'documento',
        'celular_uno',
        'celular_dos',
        'casa',
        'codigo_casa',
        'numero_casa',
        'codigo_uno',
        'celular_numuno',
        'codigo_dos',
        'celular_numdos',
        'identificador'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getDocumentoAttribute()
    {
        /*
        $valor = strlen($this->attributes['numero']);
        if ($valor <= 8) {
            return $this->attributes['tipo'] . '-' . ($this->attributes['numero']);
        } else {
            $string = $this->attributes['numero'];
            $lengthOfString = strlen($string);
            $lastCharPosition = $lengthOfString - 1;
            $lastChar = $string[$lastCharPosition];
            return $this->attributes['tipo'] . '-' . substr($this->attributes['numero'], 0, 8) . '-' . $lastChar;
        }
        */
        if ($this->attributes['rif'] == '') {
            return $this->attributes['tipo'] . '-' . $this->attributes['numero'] ;
        } else {
            return $this->attributes['tipo'] . '-' . $this->attributes['numero'] . '-' . $this->attributes['rif'];
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
        $valor1 = strlen($this->attributes['celular_principal']);
        if ($valor1 != 0) {
            return substr($this->attributes['celular_principal'], 0, 4) . '-' . substr($this->attributes['celular_principal'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCelularDosAttribute()
    {
        $valor2 = strlen($this->attributes['celular_secundario']);
        if ($valor2 != 0) {
            return substr($this->attributes['celular_secundario'], 0, 4) . '-' . substr($this->attributes['celular_secundario'], 4, 7);
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
    public function getNumeroCAsaAttribute()
    {
        $valor5 = strlen($this->attributes['habitacion']);
        if ($valor5 != 0) {
            return substr($this->attributes['habitacion'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCodigoUnoAttribute()
    {
        $valor6 = strlen($this->attributes['celular_principal']);
        if ($valor6 != 0) {
            return substr($this->attributes['celular_principal'], 0, 4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCelularNumunoAttribute()
    {
        $valor7 = strlen($this->attributes['celular_principal']);
        if ($valor7 != 0) {
            return substr($this->attributes['celular_principal'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCodigoDosAttribute()
    {
        $valor8 = strlen($this->attributes['celular_secundario']);
        if ($valor8 != 0) {
            return substr($this->attributes['celular_secundario'], 0, 4);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCelularNumdosAttribute()
    {
        $valor9 = strlen($this->attributes['celular_secundario']);
        if ($valor9 != 0) {
            return substr($this->attributes['celular_secundario'], 4, 7);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos
    public function actores()
    {
        return $this->hasMany('App\Models\Actor');
    }

}
