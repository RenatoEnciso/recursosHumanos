<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\Acta;
use App\Models\Acta_Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF; //use PDF
use Symfony\Component\Console\Descriptor\Descriptor;

class ReporteController extends Controller
{

    public function create()
    {
        $personas = Persona::all();
        return view('Reporte.create',compact('personas'));
    }

    public function generarPDF(){
        
        $ciudadanos=Acta_Persona::select('*')
        ->join('persona as P','P.DNI','=','acta_persona.DNI')
        ->join('ficha_registro as FR','FR.idficha','=','acta_persona.idActa')
        ->where('FR.estado','=','Aprobado')
        ->where('P.estado','=','1')
        ->get();

        $fecha=date('Y-m-d');
        $fecha_hoy=date_create();
        
        $nroCiudadanos=1;
        $data=compact('ciudadanos','fecha','nroCiudadanos','fecha_hoy');

        $pdf=PDF::loadView('Reporte.pdf',$data);
        //$solicitud=Solicitud::where('DNISolicitante','=',$datosA->dni)->paginate();
        //$acta=Acta_Persona::where('DNI','=',$datosA->dni)->paginate();
        //$persona=Persona::where('dni','=',$datosA->dni)->paginate();
        //$pdf = PDF::loadView('Informe.pdf',['persona'=>$persona,'solicitud'=>$solicitud,'acta'=>$acta]);
        
        //return $pdf->stream();
        return $pdf->download('Reporte.pdf');
    }
    
}



