<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return $request;

        $dato= DB::select("select * from persona as p
        inner join acta_persona as ap
        on p.dni=ap.dni
        inner join acta as a
        on a.idActa=ap.idActa
        inner join acta_nacimiento as am
        on am.idActa=a.idActa
        where year(am.fecha_nacimiento)=$request->ano and
        p.apellido_paterno='$request->primer_apellido' and
        p.apellido_materno='$request->segundo_apellido' and
        p.nombres='$request->prenombres'
        ");

        if($dato){
            $mensaje="Acta ubicada en RENIEC";
            return $mensaje;

        }
        $mensaje="Acta no se encuentra, acercarse a registrar el acta de nacimiento";
       return $mensaje;
        
    }
}
