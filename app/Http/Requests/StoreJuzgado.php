<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJuzgado extends FormRequest
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
            'descripcion'=>'required|unique:juzgados|max:50'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'nombre del juzgado, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'El juzagdo, ya existe'
        ];
    }
}
