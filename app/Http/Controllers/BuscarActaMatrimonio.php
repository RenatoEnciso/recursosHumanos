<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarActaMatrimonio extends Controller
{
    public function index(){

        return view('SubSistemaConsultas.ConsultaActa.Matrimonio.consultar');
    }

    public function search(Request $request){
        $this->validate($request,
        ['ano'=>'required|numeric',
        'mes'=>'required',
        'primer_apellido'=>'required|',
        'segundo_apellido'=>'required',
        'prenombres'=>'required']
        );
        
    }
}
