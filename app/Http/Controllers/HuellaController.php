<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HuellaController extends Controller
{
 
    public function index()
    {

        return view('SubSistemaConsultas.ConsultaHuella.huella');
    }

    public function search(Request $request)
    {
        //return $request;
        $mensaje='vacio';
        $response= Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
            'secret'=>'6Lfn6lIpAAAAANEofGmAPHmKU_VXrXSs6MkucMQa',
            'response'=>$request->input('g-recaptcha-response')
        ])->object();

        // if($response->success && $response->score >=0.5){
            
            $this->validate(
                $request,
                [
                    'dni' => 'required|numeric'
                ],
                [
                   'dni.required'=>'Ingresar datos',
                   'dni.numeric'=>'Ingresar solo numeros' ,
                ]
            );

            // Huella Izquierda
        $huellaIzquierda = DB::select(
        "select max(hp.calidadHuella) as MejorHuella, 
        p.DNI,
        p.Apellido_Paterno,
        p.Apellido_Materno,
        h.idMano,
        h.nombreHuella
        from persona as p
                inner join huella_persona as hp
                on p.dni=hp.idHuellaPersona
                inner join huella as h
                on h.idHuella=hp.idHuella
                where p.dni='$request->dni'
                and h.idMano=1
                group by p.DNI,
        p.Apellido_Paterno,
        p.Apellido_Materno,
        h.idMano,
        h.nombreHuella
        ");
        
            // Huella derecha
        $huellaDerecha = DB::select("select max(hp.calidadHuella) as MejorHuella, 
        p.DNI,
        p.Apellido_Paterno,
        p.Apellido_Materno,
        h.idMano,
        h.nombreHuella
        from persona as p
                inner join huella_persona as hp
                on p.dni=hp.idHuellaPersona
                inner join huella as h
                on h.idHuella=hp.idHuella
                where p.dni='$request->dni'
                and h.idMano=2
                group by p.DNI,
        p.Apellido_Paterno,
        p.Apellido_Materno,
        h.idMano,
        h.nombreHuella
            ");

        $datos= array("huellaDerecha"=>$huellaDerecha,"huellaIzquierda"=>$huellaIzquierda);
        
        if ($huellaDerecha) {
            $mensaje = 'Consulta Exitosa';
            $data=[
                'success'=>$mensaje,
                'datos'=>$datos
            ];
            
            
          //  return $data;
            return view('SubSistemaConsultas.ConsultaHuella.detallesHuellas')->with('data',$data);
        }
        $mensaje = "AVISO";
        $data=[
            'success'=>$mensaje,
            'datos'=>$datos
        ];
        
       
        
        return view('SubSistemaConsultas.ConsultaHuella.detallesHuellas')->with('data',$data);
            

        //  }else{
        //      return 'el usuario es un bot';
        //  }   
     

      

    }
    public function regresar()
    {
        return view('Externo.index');
    }

    public function detallesHuellas(){
        return view('SubSistemaConsultas.ConsultaHuella.detallesHuellas');
    }


}
