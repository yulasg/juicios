<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActividad extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'descripcion'=>'required|unique:actividades|max:50'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'nombre de la actividad procesal, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'El nombre de la actividad procesal, ya existe'
        ];
    }
}
