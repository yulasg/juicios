<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJuicio extends FormRequest
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
            'internacional'=>'required',
            'origen'=>'required',
            'procedencia_id'=>'required',
            'ubicacion_id'=>'required',
            'estatu_id'=>'required',
            'expediente'=>'required',
            'tribunal_id'=>'required',
            'interno_id'=>'required',
            'externo_id'=>'required',
            'obligacion_id'=>'required',
            'estado_id'=>'required',
            'demanda_id'=>'required',
            'pretension_id'=>'required',
            'garantia_id'=>'required',
            'llevado'=>'required',
            'medida_id'=>'required',
            'practicada'=>'required',
            'moneda'=>'required',
        ];
    }

    public function attributes()
    {
        return [
            //
            'internacional'=>'tipo de juicio, ',
            'origen'=>'origen del juicio, ',
            'procedencia_id'=>'procedencia, ',
            'ubicacion_id'=>'estado, ',
            'estatu_id'=>'estatu del juicio, ',
            'expediente'=>'expediente del juicio, ',
            'tribunal_id'=>'tribunal, ',
            'interno_id'=>'abogado interno, ',
            'externo_id'=>'abogado externo, ',
            'obligacion_id'=>'tip de obligación, ',
            'estado_id'=>'estado procesal del juicio, ',
            'demanda_id'=>'tipo de proceso del juicio, ',
            'pretension_id'=>'tipo de pretesión, ',
            'garantia_id'=>'tip de garabtían, ',
            'llevado'=>'llevado por, ',
            'medida_id'=>'tipo de medida del juicio, ',
            'practicada'=>'practicada, ',
            'moneda'=>'tip de moneda, ',

        ];
    }


}
