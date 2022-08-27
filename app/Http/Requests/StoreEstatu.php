<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstatu extends FormRequest
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
            'descripcion'=>'required|unique:estatus|max:50',
            'terminado'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            //
            'descripcion'=>'nombre del estatu, '
        ];
    }

    public function messages()
  
    {
        return [
            //
            'descripcion.unique'=>'El nombre del estatu, ya existe'
        ];
    }
}
