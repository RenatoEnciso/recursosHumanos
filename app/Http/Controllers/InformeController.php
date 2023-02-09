<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\TipoActa;
use App\Models\Acta_Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF; //use PDF
use Symfony\Component\Console\Descriptor\Descriptor;

class InformeController extends Controller
{

    public function create()
    {
        $personas = Persona::all();
        return view('Informe.create',compact('personas'));
    }
    public function Generar(Request $datosA)
    {
        $data = $datosA->validate(
            [
                'dni' => 'required|exists:Persona,dni',
            ],
            [
                'dni.required' => 'Falta insertar',
                'dni.exists' => 'El dni no existe',
            ]
        );
        $solicitud=Solicitud::where('DNISolicitante','=',$datosA->dni)->paginate();
        $acta=Acta_Persona::where('DNI','=',$datosA->dni)->paginate();
        $persona=Persona::where('dni','=',$datosA->dni)->paginate();
        $pdf = PDF::loadView('Informe.pdf',['persona'=>$persona,'solicitud'=>$solicitud,'acta'=>$acta]);
        return $pdf->stream();
    }
}
