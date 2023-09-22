<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuscarActaMatrimonio extends Controller
{
    public function index(){

        return view('SubSistemaConsultas.ConsultaActa.Matrimonio.consultar');
    }

    public function search(){
        
    }
}
