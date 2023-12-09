<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Persona;
use App\Models\Lista_Solicitud;
use App\Models\Persona;
use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class SolicitudController extends Controller
{
    const PAGINATION=6;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $Solicitud=Solicitud::select('*')
        ->join('persona','persona.DNI','=','solicitud.DNISolicitante')
        ->where('persona.DNI','like','%'.$buscarpor.'%')
        ->where('solicitud.estado','=',1)
        ->paginate($this::PAGINATION);
       $L_solicitud=Lista_Solicitud::select('*')
        ->join('solicitud as s','s.idSolicitud','=','lista_solicitud.idSolicitud')->get();
        return view('Solicitud.index',compact('Solicitud','buscarpor','L_solicitud'));
    }

    public function detalle(Request $request,$id){
        $buscarpor= $request->get('buscarpor');
        $Solicitud=Solicitud::findOrFail($id);
       $LSolicitud=Lista_Solicitud::select('*')
        ->where('idSolicitud','=',$id)
        ->paginate($this::PAGINATION);
        $itera=0;
        return view('Solicitud.detalle',compact('LSolicitud','Solicitud','buscarpor','itera'));
    }

    public function create(){
       // if (Auth::user()->rol=='Administrativo'){    //boton registrar
                $actas=Acta::all();
                $personas = Persona::all();
                $Actas_Personas=Acta_Persona::all();
                return view('Solicitud.create',compact('Actas_Personas','actas','personas'));
       // } else{
                return redirect()->route('Solicitud.index')->with('datos','..::No tiene Acceso ..::');
       // }
    }

    public function store(Request $request){
                // return $request;
                $data=request()->validate([
                    'observacion'=>'required|max:40',
                    'idActa'=>'required'  ,
                    'DNISolicitante'=>'required'  ,
                ],
                [
                    /* 'Observacion.required'=>'Ingrese Observacion de Solicitud',
                    'Observacion.max'=>'Maximo 40 caracteres para la Observacion', */
                ]);

                $Solicitud=new Solicitud();
                $Solicitud->fechaSolicitud=Carbon::now();
                $Solicitud->observacion=$request->observacion;
                $Solicitud->DNISolicitante= $request->DNISolicitante;
                $Solicitud->estado= 1;
                $Solicitud->pago= 0;
                $Solicitud->save();

                //Guardamos en la lista de solicitudes
                for ($i=0; $i <count($request->idActa) ; $i++) {
                    $L_Solicitud=new Lista_Solicitud();
                    $L_Solicitud->idSolicitud=$Solicitud->idSolicitud;
                    $L_Solicitud->idActa=$request->idActa[$i];
                    $L_Solicitud->save();
                }
                return redirect()->route('Solicitud.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol=='Administrativo'){ //boton editar
            $Solicitud= Solicitud::findOrFail($id);
            $Lista_Solicitud=Lista_Solicitud::select('*')
            ->where('idSolicitud','=',$id)->get();
            $personas = Persona::all();
            $Actas_Personas=Acta_Persona::all();
            $ban=0;
            return view('Solicitud.edit',compact('Actas_Personas','Solicitud','personas','Lista_Solicitud','ban'));
        }else{
                return redirect()->route('Solicitud.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request,$id)
    {
        $data=request()->validate([
            'observacion'=>'required|max:40',
            'idActa'=>'required'  ,
            'DNISolicitante'=>'required'  ,
        ],
        [
            /* 'Observacion.required'=>'Ingrese Observacion de Solicitud',
            'Observacion.max'=>'Maximo 40 caracteres para la Observacion', */
        ]);



        $Solicitud=Solicitud::findOrFail($id);
        $Solicitud->observacion=$request->observacion;
        $Solicitud->DNISolicitante= $request->DNISolicitante;
        $Solicitud->save();

        //Eliminamos todas las actas solicitadas
        $L_SolicitudB=Lista_Solicitud::where('idSolicitud','=',$id)->get(); //Retorna un arreglo
        for ($i=0; $i <count($L_SolicitudB); $i++) {
             $L_SolicitudB[$i]->delete();
        }

        //creamos nuevamentes las actas
        for ($i=0; $i <count($request->idActa); $i++) {
            $L_Solicitud=new Lista_Solicitud();
            $L_Solicitud->idSolicitud=$Solicitud->idSolicitud;
            $L_Solicitud->idActa=$request->idActa[$i];
            $L_Solicitud->save();
        }



        return redirect()->route('Solicitud.index')->with('datos','Registro Nuevo Actualizado ...!');
    }

    public function destroy($id){

            $Solicitud=Solicitud::findOrFail($id);
            $Solicitud->estado=0;
            $Solicitud->save();

            $L_Solicitud=Lista_Solicitud::where('idSolicitud','=',$id)->get(); //Retorna un arreglo
            for ($i=0; $i <count($L_Solicitud); $i++) {
                $L_Solicitud[$i]->delete();
            }

            return redirect()->route('Solicitud.index')->with('datos','Registro Eliminado ...!');
    }

    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){  //boton eliminar
            $Solicitud=Solicitud::findOrFail($id);
            return view('Solicitud.confirmar',compact('Solicitud'));
            return redirect()->route('Solicitud.index')->with('datos','Registro Eliminado ...!');
        }else{
                return redirect()->route('Solicitud.index')->with('datos','..::No tiene Acceso ..::');
        }
    }
    public function archivo($idActa){
        $acta=Acta::findOrFail($idActa);

        return view('Solicitud.archivo',compact('acta'));
    }


    public function cancelar(){
        return redirect()->route('Solicitud.index')->with('datos','acciona cancelada...');
    }

    public function OrdenGenerado($id){
        if (Auth::user()->rol=='Recepcionista'){   //boton generar orden
            $solicitud=Solicitud::findOrFail($id);
            $fecha = date('Y-m-d');
            $data = compact('solicitud','fecha');
            $pdf = Pdf::loadView('Solicitud.ordenDePago', $data);
            return $pdf->download('OrdenDePagoGenerada.pdf');
        }else{
            return redirect()->route('Solicitud.index')->with('datos','..::No tiene Acceso solo el Recepcionista ..::');
        }
    }

    public function ComprobanteGenerado($id){

        $solicitud=Solicitud::findOrFail($id);
        $fecha = date('Y-m-d');
        $data = compact('solicitud','fecha');
        $pdf = Pdf::loadView('Solicitud.ComprobantePago', $data);

        return $pdf->download('ComprobanteDePagoGenerada.pdf');

    }

    public function pago(Request $request,$id){
        $Solicitud=Solicitud::findOrFail($id);

        if($request->archivo!=""){

            // $archivo=$request->file('archivo')->store('PagosRealizados','public');
            // $url = Storage::url($archivo);
            $Solicitud->pago=1;
        }

        $Solicitud->save();
        return redirect()->route('Solicitud.index')->with('datos','Pago Guardado ...!');
    }

    public function ingresarPago($id){
        if (Auth::user()->rol=='Cajero'){   //Registrar orden de pago
            $Solicitud= Solicitud::findOrFail($id);
            $Lista_Solicitud=Lista_Solicitud::select('*')
            ->where('idSolicitud','=',$id)->get();
            $personas = Persona::all();
            $Actas_Personas=Acta_Persona::all();
            $ban=0;
            return view('Solicitud.pago',compact('Actas_Personas','Solicitud','personas','Lista_Solicitud','ban'));
        }else{
            return redirect()->route('Solicitud.index')->with('datos','..::No tiene Acceso  solo el Cajero  ..::');
        }
    }


}


