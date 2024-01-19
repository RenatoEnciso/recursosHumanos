<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarActaNacimiento extends Controller
{
    public function index()
    {

        return view('SubSistemaConsultas.ConsultaActa.Nacimiento.consultar');
    }

    public function search(Request $request)
    {
        $this->validate(
            $request,
            [
                'fecha' => 'required|date',
                'primer_apellido' => 'required',
                'segundo_apellido' => 'required',
                'prenombres' => 'required'
            ],
            [
                'fecha.required'=>'Seleccionar la fecha',
                'fecha.date'=>'Solo ingresar dato en formato fecha',
                'primer_apellido.required'=>'Ingresar  el primer apellido',
                'segundo_apellido.required'=>'Ingresar el segundo apellido',
                'prenombres.required'=>'Ingresar los nombres'
            ]
        );
     
        $dato = DB::select("select * from persona as p
        inner join acta_persona as ap
        on p.dni=ap.dni
        inner join acta as a
        on a.idActa=ap.idActa
        inner join acta_nacimiento as am
        on am.idActa=a.idActa
        where am.fecha_nacimiento=$request->fecha and
        p.apellido_paterno='$request->primer_apellido' and
        p.apellido_materno='$request->segundo_apellido' and
        p.nombres='$request->prenombres'
        ");
        if ($dato) {
            $success = 'Acta ubicada en RENIEC';
            return redirect()->route('ConsultaNacimiento')->with('success', $success);
        }
 
        $alert = "Acta no se encuentra, acercarse a registrar el acta de nacimiento";
        return redirect()->route('ConsultaNacimiento')->with('alert', $alert);
    }

    
    public function regresar()
    {
        return view('Externo.index');
    }
}
