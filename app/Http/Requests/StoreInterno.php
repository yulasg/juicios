<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterno extends FormRequest
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
            'nombre'=>'required|unique:internos|max:100'
        ];
    }

    public function attributes()
    {
        return [
            //
            'nombre'=>'nombre del abogado interno, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'nombre.unique'=>'El nombre del abogado interno, ya existe'
        ];
    }

}
