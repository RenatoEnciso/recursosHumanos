<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolDniPrimeraVezCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'DNI'=>'required',
            'codigo_voucher'=>'required',
            'codigo_recibo'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'DNI.required'=>'Ingrese Numero de DNI',
            'codigo_voucher.required'=>'Ingrese un vocuher',
            'codigo_recibo.required'=>'Ingrese el codigo de servicio presentado',
        ];
    }
    
}
