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
            'file_foto'=>'required',
            'file_voucher'=>'required',
            'cod_agua'=>'required',
            'cod_luz'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'DNI.required'=>'Ingrese Numero de DNI',
            'file_foto.required'=>'Inngrese la foto actual tamaño pasaporte',
            'file_voucher.required'=>'Ingrese un vocuher',
            'cod_agua.required'=>'Ingrese el codigo de servicio de agua',
            'cod_luz.required'=>'Ingrese el codigo de servicio de luz',
        ];
    }
    
}
