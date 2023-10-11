<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarActaMatrimonio extends Controller
{
    public function index()
    {

        return view('SubSistemaConsultas.ConsultaActa.Matrimonio.consultar');
    }

    public function search(Request $request)
    {
        $this->validate(
            $request,
            [
                'ano' => 'required|numeric',
                'mes' => 'required',
                'primer_apellido' => 'required|',
                'segundo_apellido' => 'required',
                'prenombres' => 'required'
            ],
            [
               'ano.required'=>'Ingresar el año',
               'ano.numeric'=>'Ingresar solo numeros' ,
               'mes.required'=>'Seleccionar el mes',
               'primer_apellido.required'=>'Ingresar el primer nombre',
               'segundo_apellido.required'=>'Ingresar el segundo nombre',
               'prenombres.required'=>'Ingresar los nombres',
            ]
        );

        $dato = DB::select("select * from persona as p
        inner join acta_persona as ap
        on p.dni=ap.dni
        inner join acta as a
        on a.idActa=ap.idActa
        inner join acta_matrimonio as am
        on am.idActa=a.idActa
        where year(am.fecha_matrimonio)=$request->ano and
        month(am.fecha_matrimonio)=$request->mes and
        p.apellido_paterno='$request->primer_apellido' and
        p.apellido_materno='$request->segundo_apellido' and
        p.nombres='$request->prenombres'
        ");
        if ($dato) {
            $success = 'Acta ubicada en RENIEC';
            return redirect()->route('ConsultaDefuncion')->with('success', $success);
        }

        $alert = "Acta no se encuentra, acercarse a registrar el acta de nacimiento";
        return redirect()->route('ConsultaDefuncion')->with('alert', $alert);
    }
    public function regresar()
    {
        return view('auth.login');
    }
}
