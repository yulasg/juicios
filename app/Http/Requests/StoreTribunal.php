<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTribunal extends FormRequest
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
            'descripcion'=>'required|unique:tribunales|max:50',
            'juzgado_id'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'tribunal, ',
            'juzgado_id'=>'juzgado, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'El tribunal, ya existe'
        ];
    }
    
}
