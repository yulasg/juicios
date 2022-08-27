<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Abogado extends Model
{
    use HasFactory;
    use SoftDeletes;

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    protected $fillable =
    [
        'juicio_id',
        'interno_id',
        'fecha',
        'usuario'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $dates =
    [
        'fecha'
    ];

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getFechaAttribute($value)
    {
        //return date('d-m-Y', strtotime($value));
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    //Relacion uno a muchos (inversa)
    public function juicio()
    {
        return $this->belongsTo('App\Models\Juicio');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa) abogado interno
    public function interno()
    {
        return $this->belongsTo('App\Models\Interno');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa) abogado interno
    /*
    public function jefe()
    {
        return $this->belongsTo('App\Models\Interno','jefe_id');
    }
    */
}
