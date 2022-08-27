<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEspecialidad extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            //
            'descripcion'=>'required|unique:especialidades|max:50',
            'internacional'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'nombre de la especialidad, ',
            'internacional'=>'tipo de juicio, ',
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'El nombre de la especialidad, ya existe'
        ];
    }
}
