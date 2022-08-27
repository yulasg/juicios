<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExterno extends FormRequest
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
            'nombre'=>'required|unique:externos|max:100'
        ];
    }

    public function attributes()
    {
        return [
            //
            'nombre'=>'nombre del abogado externo, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'nombre.unique'=>'El nombre del abogado externo, ya existe'
        ];
    }
}
