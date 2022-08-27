<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedencia extends FormRequest
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
            'descripcion'=>'required|unique:procedencias|max:50',
            'codigo'=>'required|unique:procedencias|numeric'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'descripción de la procedencia, ',
            'codigo'=>'código de la procedencia, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'La descripción de la procedencia, ya existe',
            'codigo.unique'=>'El código de la procedencia, ya existe'
        ];
    }
}
