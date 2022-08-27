<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estatu extends Model
{
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable = ['descripcion','terminado'];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos
    public function juicios()
    {
        return $this->hasMany('App\Models\Juicio');
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function getTerminadoAttribute($value)
    {
        switch ($this->attributes['terminado']) {
            case 'S':
                $value =  'Si';
                break;
            case 'N':
                $value = 'No';
                break;
        }
        return ($value);
    }
    
    
}
