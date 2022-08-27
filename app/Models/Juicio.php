<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seguimiento;
use App\Models\Movimiento;
use Illuminate\Database\Eloquent\SoftDeletes;


class Juicio extends Model
{
    use HasFactory;
    use SoftDeletes;
    


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable =
    [
        'internacional',
        'especialidad_id',
        'origen',
        'procedencia_id',
        'ubicacion_id',
        'estatu_id',
        'expediente',
        'tribunal_id',
        'interno_id',
        'externo_id',
        'obligacion_id',
        'estado_id',
        'demanda_id',
        'pretension_id',
        'garantia_id',
        'llevado',
        'medida_id',
        'practicada',
        'moneda',
        'admision',
        'asignacion',
        'actuacion',
        'movimiento',
        'creacion',
        'representante',
        'usuario'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $dates =
    [
        'admision',
        'asignacion',
        'actuacion',
        'movimiento',
        'creacion'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $appends =
    [
        'fecha_admision',
        'fecha_asignacion',
        'fecha_actuacion',
        'fecha_movimiento',
        'fecha_creacion',
        'tipo',
        'apoderado'
    ];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAdmisionAttribute($value)
    {
        //return date('d-m-Y', strtotime($value));
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaAdmisionAttribute()
    {
        return $this->attributes['admision'] = Carbon::createFromFormat('Y-m-d', $this->attributes['admision'])->format('Y-m-d');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getAsignacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaAsignacionAttribute()
    {
        return $this->attributes['asignacion'] = Carbon::createFromFormat('Y-m-d', $this->attributes['asignacion'])->format('Y-m-d');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getCreacionAttribute($value)
    {
        //return date('d-m-Y', strtotime($value));
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaCreacionAttribute()
    {
        if ($this->creacion) {
            return $this->attributes['creacion'] = Carbon::createFromFormat('Y-m-d', $this->attributes['creacion'])->format('Y-m-d');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getActuacionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaActuacionAttribute()
    {
        if ($this->actuacion) {
            return $this->attributes['actuacion'] = Carbon::createFromFormat('Y-m-d', $this->attributes['actuacion'])->format('Y-m-d');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getMovimientoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y') : null;
    }
    public function getFechaMovimientoAttribute()
    {
        if ($this->movimiento) {
            return $this->attributes['movimiento'] = Carbon::createFromFormat('Y-m-d', $this->attributes['movimiento'])->format('Y-m-d');
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function medida()
    {
        return $this->belongsTo('App\Models\Medida');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function obligacion()
    {
        return $this->belongsTo('App\Models\Obligacion');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa) estado procesal
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa) abogado interno
    public function interno()
    {
        return $this->belongsTo('App\Models\Interno');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa) abogado externo
    public function externo()
    {
        return $this->belongsTo('App\Models\Externo');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function demanda()
    {
        return $this->belongsTo('App\Models\Demanda');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function procedencia()
    {
        return $this->belongsTo('App\Models\Procedencia');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function ubicacion()
    {
        return $this->belongsTo('App\Models\Ubicacion');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function garantia()
    {
        return $this->belongsTo('App\Models\Garantia');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function pretension()
    {
        return $this->belongsTo('App\Models\Pretension');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)

    public function tribunal()
    {
        return $this->belongsTo('App\Models\Tribunal');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function juzgado()
    {
        return $this->tribunal->belongsTo('App\Models\Juzgado');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function estatu()
    {
        return $this->belongsTo('App\Models\Estatu');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos (inversa)
    public function especialidad()
    {
        return $this->belongsTo('App\Models\Especialidad');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos relaciones
    public function relaciones()
    {
        return $this->hasMany('App\Models\Relacion');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos relaciones
    public function relaciones1()
    {
        return $this->hasMany('App\Models\Relacion', 'juicio1_id');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos demandantes y demandados
    public function personas()
    {
        return $this->hasMany('App\Models\Persona');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos parte actoral
    public function actores()
    {
        return $this->hasMany('App\Models\Actor');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos seguimientos
    public function seguimientos()
    {
        return $this->hasMany('App\Models\Seguimiento');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos movimientos
    public function movimientos()
    {
        return $this->hasMany('App\Models\Movimiento');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos movimientos
    public function documentos()
    {
        return $this->hasMany('App\Models\Documento');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a uno datos
    public function dato()
    {
        return $this->hasOne('App\Models\Dato');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    public function setExpedienteAttribute($value)
    {
        $this->attributes['expediente'] = strtolower($value);
    }
    public function getExpedienteAttribute($value)
    {
        return ucwords($value);
    }
    */
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getApoderadoAttribute($value)
    {
        switch ($this->attributes['representante']) {
            case 'U':
                $value =  'Único';
                break;
            case 'V':
                $value =  'Varios';
                break;
            case 'N':
                $value = 'Ninguno';
                break;
        }
        return ($value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getTipoAttribute($value)
    {
        switch ($this->attributes['internacional']) {
            case 'I':
                $value =  'Internacional';
                break;
            case 'N':
                $value = 'Nacional';
                break;
        }
        return ($value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
    public function getInternacionalAttribute($value)
    {
        switch ($this->attributes['internacional']) {
            case 'I':
                $value =  'Internacional';
                break;
            case 'N':
                $value = 'Nacional';
                break;
        }
        return ($value);
    }
    */
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getOrigenAttribute($value)
    {
        switch ($this->attributes['origen']) {
            case 'F':
                $value = 'Fogade';
                break;
            case 'B':
                $value = 'Banca en Liquidación';
                break;
            case 'A':
                $value = 'Fogade / Banca en Liquidación';
                break;
            case 'C':
                $value = 'Crédito Cedido a Fogade';
                break;
        }
        return  $value;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getLlevadoAttribute($value)
    {
        switch ($this->attributes['llevado']) {
            case 'CJ':
                $value =  'Consultoría Jurídica';
                break;
            case 'AE':
                $value = 'Abogado Externo';
                break;
            case 'NA':
                $value = 'Sin Valor Sistema Anterior';
                break;
        }
        return ($value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getPracticadaAttribute($value)
    {
        switch ($this->attributes['practicada']) {
            case 'S':
                $value =  'Si';
                break;
            case 'N':
                $value = 'No';
                break;
        }
        return ($value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getMonedaAttribute($value)
    {
        switch ($this->attributes['moneda']) {
            case 'US':
                $value =  'Dólares $';
                break;
            case 'BS':
                $value = 'Bolívares Bs.F.';
                break;
            case 'NA':
                $value = 'Sin Valor';
                break;
        }
        return ($value);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getFechaAttribute($value)
    {
        return $value ?  Carbon::parse($value)->format('d/m/Y') : null;
    }


    public function ultimoSeguimiento()
    {
        return $this->belongsTo(Seguimiento::class);
    }
    public function scopeWithUltimoSeguimiento($query)
    {

        $subselect = Seguimiento::select('seguimientos.id')
            ->whereColumn('seguimientos.juicio_id', 'juicios.id')
            ->latest('fecha')
            ->limit(1);

        $query->addSelect([
            'ultimo_seguimiento_id' => $subselect,
        ]);

        $query->with('ultimoSeguimiento');
    }

    public function ultimoMovimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
    public function scopeWithUltimoMovimiento($query)
    {

        $subselect = Movimiento::select('movimientos.id')
            ->whereColumn('movimientos.juicio_id', 'juicios.id')
            ->latest('fecha')
            ->limit(1);

        $query->addSelect([
            'ultimo_movimiento_id' => $subselect,
        ]);

        $query->with('ultimoMovimiento');
    }
}
