<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Externo extends Model
{
    use HasFactory;
    use SoftDeletes;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $fillable = ['nombre'];
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Relacion uno a muchos
    public function juicios()
    {
        return $this->hasMany('App\Models\Juicio');
    }
}
