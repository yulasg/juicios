<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePretension extends FormRequest
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
            'descripcion'=>'required|unique:pretensiones|max:50'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'descripción del tipo de pretensión, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'La descripción del tipo de pretensión, ya existe'
        ];
    }
}
