<?php

namespace SisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaCreditoFormRequest extends FormRequest
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
            'idventa'           => 'required|unique:tb_nota_credito,idventa',
            'num_noce'   => 'required|max:10',
            'serie_noce'   => 'required|max:10',
            'idarticulo'            => 'required',
            'cantidad'              => 'required',
            'precio_venta'          => 'required',            
            'total_credito'      => 'required'
           
        ];        
    }
    public function messages()
    {
        return [
            'idventa.unique' => 'Numero de Factura contiene una nota de debito',
        ];
    }
}
