<?php

namespace SisVentas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
            'idcliente'        => 'required',
            'idvendedor' => 'required',
            'tipo_comprobante'   => 'max:20',
            'serie_comprobante'  => 'max:7',
            'num_comprobante'    => 'required|max:10',
            'idarticulo'         => 'required',
            'cantidad'           => 'required',
            'precio_venta'      => 'required',
            'descuento'      => 'required',
            'total_venta'      => 'required'
        ];
    }
    public function messages()
    {
        return [
            'idcliente.required' => 'Olvidaste el nombre del Cliente',
            'idvendedor.required' => 'Olvidaste el nombre del Proveedor',
        ];
    }
}
