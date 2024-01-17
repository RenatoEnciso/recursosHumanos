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

        $response= Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
            'secret'=>'6Lfn6lIpAAAAANEofGmAPHmKU_VXrXSs6MkucMQa',
            'response'=>$request->input('g-recaptcha-response')
        ])->object();

        if($response->success && $response->score >=0.5){
            
            $this->validate(
                $request,
                [
                    'dni' => 'required|numeric'
                ],
                [
                   'dni.required'=>'Ingresar el año',
                   'dni.numeric'=>'Ingresar solo numeros' ,
                ]
            );

            // Huella Izquierda
        $huellaIzquierda = DB::select("select max(hp.calidadHuella), p.* from persona, h.* as p
        inner join huella_persona as hp
        on p.dni=hp.dni
        inner join huella as h
        on h.idHuella=hp.idHuella
        where p.dni=$request->dni 
        and h.idMano=1
        ");

            // Huella derecha
        $huellaDerecha = DB::select("select max(hp.calidadHuella), p.* , h.* from persona as p
            inner join huella_persona as hp
            on p.dni=hp.dni
            inner join huella as h
            on h.idHuella=hp.idHuella
            where p.dni=$request->dni 
            and h.idMano=2
            ");

        $datos= array("huellaDerecha"=>$huellaDerecha,"huellaIzquierda"=>$huellaIzquierda);

        if ($datos) {
            $success = 'Consulta Exitosa';
            return redirect()->route('ConsultaHuella')->with('success', $success);
        }

        $alert = "ERROR no se encotraron sus huella, dirijase a RENIEC";
        return redirect()->route('ConsultaHuella')->with('alert', $alert);
            

        }else{
            return 'el usuario es un bot';
        }   
     

      

    }
    public function regresar()
    {
        return view('Externo.index');
    }


}
