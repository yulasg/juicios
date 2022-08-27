<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{ 
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable = ['inicio', 'destino', 'asunto', 'referencia1', 'referencia2','usuario'];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getInicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y h:i:s A') : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $appends =
    [
        'fecha_inicio',
        'hora_inicio'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFechaInicioAttribute()
    {
        $value = $this->attributes['inicio'];
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getHoraInicioAttribute()
    {
        $value = $this->attributes['inicio'];
        return $value ? Carbon::parse($value)->format('H:i:s') : null;
    }
}