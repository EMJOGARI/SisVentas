<?php

namespace SisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaDebitoFormRequest extends FormRequest
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
            'idventa'           => 'required|unique:tb_nota_debito,idventa',
            'num_comprobante'   => 'required|max:10',
            'idarticulo'            => 'required',
            'cantidad'              => 'required',
            'precio_venta'          => 'required',
            'descuento'             => 'required',
            'total_debito'      => 'required'
           
        ];        
    }
    public function messages()
    {
        return [
            'idventa.unique' => 'Numero de Factura contiene una nota de debito',
        ];
    }
}
