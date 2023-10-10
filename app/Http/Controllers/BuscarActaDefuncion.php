<?php

namespace App\Http\Controllers;

use App\Models\Acta_Defunsion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarActaDefuncion extends Controller
{
  public function index()
  {

    return view('SubSistemaConsultas.ConsultaActa.Defuncion.consultar');
  }

  public function search(Request $request)
  {
    $this->validate(
      $request,
      [
        'ano' => 'required|numeric',
        'primer_apellido' => 'required|',
        'segundo_apellido' => 'required',
        'prenombres' => 'required'
      ]
    );

    $dato = DB::select("select * from acta_defuncion as a 
       inner join persona as p
        on a.dniFallecido=p.DNI 
          where year(a.fecha_fallecido)=$request->ano and 
            p.apellido_paterno='$request->primer_apellido' and
             p.apellido_materno='$request->segundo_apellido' and
              p.nombres='$request->prenombres'");

    if ($dato) {
      $success = 'Acta ubicada en RENIEC';
      return redirect()->route('ConsultaDefuncion')->with('success', $success);
    }

    $alert = "Acta no se encuentra, acercarse a registrar el acta de nacimiento";
    return redirect()->route('ConsultaDefuncion')->with('alert', $alert);
  }
}
