<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbogado extends FormRequest
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
            'nombre'=>'required|max:50',
            'apellido'=>'required|max:50',
            'tipo'=>'required|max:50',
        ];
    }

    public function attributes()
    {
        return [
            //
            'nombre'=>'nombre del abogado',
            'apellido'=>'apellido del abogado',
            'tipo'=>'tipo del abogado',    
        ];
    }


}
