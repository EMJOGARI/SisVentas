<?php

namespace SisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
            'nombre'=>'required|max:255',
            'tipo_documento'=>'required|max:10',
            'num_documento'=>'required|max:15',
            'direccion'=>'required|max:255',
            'telefono'=>'required|max:15'
        ];
    }
}
