<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodin extends Model
{
    use HasFactory;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        protected $table = "comodines";
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
        protected $fillable =
        [
            'juicio_id',
            'comodin1',
            'comodin2',
            'comodin3',
            'comodin4',
            'comodin5',
            'comodin6',
            'comodin7',
            'comodin8',
        ];
}
