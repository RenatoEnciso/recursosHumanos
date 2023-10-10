<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarActaNacimiento extends Controller
{
    public function index(){

        return view('SubSistemaConsultas.ConsultaActa.Nacimiento.consultar');
    }

    public function search(Request $request){
        $this->validate($request,
        ['fecha'=>'required|date',
        'primer_apellido'=>'required|',
        'segundo_apellido'=>'required',
        'prenombres'=>'required']
        );
        
    }
}
