<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarActaDefuncion extends Controller
{
    public function index(){

        return view('SubSistemaConsultas.ConsultaActa.Defuncion.consultar');
    }

    public function search(Request $request){
        $this->validate($request,
        ['ano'=>'required|numeric',
        'primer_apellido'=>'required|',
        'segundo_apellido'=>'required',
        'prenombres'=>'required']
        );
        
    

    }
    

}
