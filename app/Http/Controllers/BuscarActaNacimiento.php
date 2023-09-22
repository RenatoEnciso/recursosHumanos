<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarActaNacimiento extends Controller
{
    public function index(){

        return view('SubSistemaConsultas.ConsultaActa.Nacimiento.consultar');
    }

    public function search(){
        
    }
}
