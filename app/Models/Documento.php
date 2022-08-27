<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
    protected $fillable = ['juicio_id', 'numero', 'inicio', 'fin','usuario'];

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $dates =
    [
        'inicio',
        'fin'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $appends =
    [
        'fecha_inicio',
        'fecha_fin'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaInicioAttribute()
    {
        return $this->attributes['inicio'] = Carbon::createFromFormat('Y-m-d', $this->attributes['inicio'])->format('Y-m-d');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFinAttribute($value)
    {
        //return date('d-m-Y', strtotime($value));
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaFinAttribute()
    {
        return $this->attributes['fin'] = Carbon::createFromFormat('Y-m-d', $this->attributes['fin'])->format('Y-m-d');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function juicio()
    {
        return $this->belongsTo('App\Models\Juicio');
    }
}
