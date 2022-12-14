<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dato extends Model
{
    use HasFactory;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    protected $fillable =
    [
        'juicio_id',
        'juicio_ente_id',
        'capital',
        'monto',
        'tasa',
        'interes',
        'mora',
        'juez',
        'observacion',
        'usuario'
    ];



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion inversa uno a uno datos
    public function juicio()
    {
        return $this->belongsTo('App\Models\Juicio');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    public function setDemandaAttribute($value)
    {
        $this->attributes['demanda'] = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d');
    }
    
   */


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCapitalAttribute($value)
    {
        return $value ? number_format($value, 2, ",", ".") : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setCapitalAttribute($value)
    {
        $this->attributes['capital'] = str_replace(',', '.', $value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    public function getMontoCapitalAttribute()
    {
        return $this->attributes['capital'] =  str_replace(',', '.', $this->attributes['capital']);
    }
    */
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getMontoAttribute($value)
    {
        return $value ? number_format($value, 2, ",", ".") : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setMontoAttribute($value)
    {
        $this->attributes['monto'] = str_replace(',', '.', $value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getMoraAttribute($value)
    {
        return $value ? number_format($value, 2, ",", ".") : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setMoraAttribute($value)
    {
        $this->attributes['mora'] = str_replace(',', '.', $value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInteresAttribute($value)
    {
        return $value ? number_format($value, 2, ",", ".") : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setInteresAttribute($value)
    {
        $this->attributes['interes'] = str_replace(',', '.', $value);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getTasaAttribute($value)
    {
        return [
            'F' => 'Fija',
            'V' => 'Variable',
            'N' => 'Sin Valor'
        ][$value];
    }
}
