<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolDniPrimeraVezCreateRequest;
use App\Models\Persona;
use App\Models\SolicitudDNI;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SolicitudDNIController extends Controller
{
    const PAGINATION=10;
   /* public function inicio(Request $request){
        return view('ciudadano.index');
    }*/

    public function index(Request $request){
        $buscarpor= $request->get('buscarpor');
        $solicitudes=SolicitudDNI::select('*')
        ->where('cod_servicio_agua','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('SolicitudDNI.index',compact('solicitudes','buscarpor'));
    }
    
    public function create(){
        return view('SolicitudDNI.create');
    }
    
    public function store(SolDniPrimeraVezCreateRequest $request){
        $persona=Persona::find($request->DNI);
        if($persona){
            $solicitud=new SolicitudDNI();
            if($request->tipoSolicitud==1){
                $solicitud->idTipoSolicitud='1';
                $solicitud->cod_servicio_agua=$request->cod_agua;
                $solicitud->cod_servicio_luz=$request->cod_luz;
            }else if($request->tipoSolicitud==2){
                $solicitud->idTipoSolicitud='2';
            }
            $solicitud->DNI=$persona->DNI;
            $foto = $request->file('file_foto'); 
            if ($foto) {            
                $nombreArchivo = $solicitud->persona->Nombres.'.'.$foto->getClientOriginalExtension();
                Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
                $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
                $solicitud->file_foto = $urlFoto;
            }

            $voucher=$request->file('file_voucher');
            if ($voucher) {
                $nombreArchivo = $solicitud->persona->Nombres.'.'.$voucher->getClientOriginalExtension();
                Storage::put('public/primeraVez/voucherDNI/' . $nombreArchivo, file_get_contents($voucher));   //guardar en storage
                $urlVoucher = Storage::url('public/primeraVez/voucherDNI/' . $nombreArchivo);  //obtener url de foto
                $solicitud->file_Voucher = $urlVoucher;
            }

            $solicitud->valida_foto=0;
            $solicitud->valida_voucher=0;
            $solicitud->solMotivo=$request->motivo;
            $solicitud->solEstado='Pendiente';
            $solicitud->solFecha=new DateTime();
            $solicitud->save();
            return redirect()->route('solicitud-dni.index')->with('notifica','La solicitud de DNI AZUL fue exitosa');
        }else{
            return redirect()->route('solicitud-dni.create')->with('notifica','La solicitud No pudo realizarse');
        }
    }

    public function edit($id){
        $solicitud=SolicitudDNI::find($id);
        $fechaNac= new DateTime($solicitud->persona->fecha_nacimiento);
        $fechaSolicitud=new DateTime($solicitud->solFecha);    
        $intervalo=date_diff($fechaSolicitud,$fechaNac);
        $edad = $intervalo->y;
        if($edad <17)
            $condEdad='El Ciudadano aún no cumple con la edad suficiente para DNI Azul';
        if($edad >=17 && $edad <=20)
            $condEdad='El Ciudadano Cumple con la edad suficiente para obtener el DNI Azul por priemra vez';
        if($edad >20)
            $condEdad='El Ciudadano Sobre pasa la edad para tramite Normal del DNI Azul';
        return view('SolicitudDNI.edit', compact('solicitud','edad','condEdad'));
    }
    public function update(Request $request, $id){
        $solicitud=SolicitudDNI::find($id);
        if($request->tipoSolicitud==1){
            //$solicitud->idTipoSolicitud='1';
            $solicitud->cod_servicio_agua=$request->cod_agua;
            $solicitud->cod_servicio_luz=$request->cod_luz;
        }else if($request->tipoSolicitud==2){
            //$solicitud->idTipoSolicitud='2';
        }

        $foto = $request->file('file_foto'); 
        if ($foto) {            
            $nombreArchivo = $solicitud->persona->Nombres.'.'.$foto->getClientOriginalExtension();
            Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
            $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
            $solicitud->file_foto = $urlFoto;
        }

        $voucher=$request->file('file_voucher');
        if ($voucher) {
            $nombreArchivo = $solicitud->persona->Nombres.'.'.$voucher->getClientOriginalExtension();
            Storage::put('public/primeraVez/voucherDNI/' . $nombreArchivo, file_get_contents($voucher));   
            $urlVoucher = Storage::url('public/primeraVez/voucherDNI/' . $nombreArchivo); 
            $solicitud->file_Voucher = $urlVoucher;
        }

        $solicitud->solMotivo=$request->motivo;
        if($request->valida_voucher==true)
            $solicitud->valida_voucher=1;

        if($request->valida_foto==true)
            $solicitud->valida_foto=1;
        
        $solicitud->solEstado='Pendiente';
        $solicitud->save();
        return view('ciudadano.index');
    }

    public function review($id){
        $solicitud=SolicitudDNI::find($id);
        $fechaNac= new DateTime($solicitud->persona->fecha_nacimiento);
        $fechaSolicitud=new DateTime($solicitud->solFecha);    
        $intervalo=date_diff($fechaSolicitud,$fechaNac);
        $edad = $intervalo->y;
        if($edad <17)
            $condEdad='El Ciudadano aún no cumple con la edad suficiente para DNI Azul';
        if($edad >=17 && $edad <=20)
            $condEdad='El Ciudadano Cumple con la edad suficiente para obtener el DNI Azul por priemra vez';
        if($edad >20)
            $condEdad='El Ciudadano Sobre pasa la edad para tramite Normal del DNI Azul';
        return view('SolicitudDNI.review', compact('solicitud','edad'))->with('notifica',$condEdad);
    }

    public function review2(Request $request, $id){
        $solicitud=SolicitudDNI::find($id);
        
        if ($request->has('valida_voucher')) {
            $solicitud->valida_voucher=1;
        }else{
            $solicitud->valida_voucher=0;
        }
        if ($request->has('valida_foto')) {
            $solicitud->valida_foto=1;
        }else{
            $solicitud->valida_foto=0;
        }
        if ($request->has('valida_serv_agua')) {
            $solicitud->valida_serv_agua=1;
        }else{
            $solicitud->valida_serv_agua=0;
        }
        if ($request->has('valida_serv_luz')) {
            $solicitud->valida_serv_luz=1;
        }else{
            $solicitud->valida_serv_luz=0;
        }

        $solicitud->save();
        return redirect()->route('solicitud-dni.index');
    }
    
    
    public function destroy($id){
        $solicitud=SolicitudDNI::find($id);
        $solicitud->delete();
        return view('ciudadano.index');
    }
    

    public function validar(Request $request){
        $request->validate([
            'dni' => 'required',
            'fechaNacimiento' => 'required|date',
            'departamento' => 'required',
            'provincia' => 'required',
            'distrito' => 'required'
        ],
        [
            'dni.required'=>'Ingrese el Numero de DNI',
            'fechaNacimiento.required'=>'Ingrese una Fecha de Nacimiento',
            'departamento.required'=>'Ingrese el departamento de
             nacimiento',
            'provincia.required'=>'Ingrese la provincia de nacimiento',
            'distrito.required'=>'Ingrese el distrito de nacimiento',
        ]);
    
        try{
            $persona1 = Persona::findOrFail($request->dni);
            $persona2 = Persona::where('fecha_nacimiento',$request->fechaNacimiento)->first();
            $persona3 = Persona::where('departamento',$request->departamento)->first();
            $persona4 = Persona::where('provincia',$request->provincia)->first();
            $persona5 = Persona::where('distrito',$request->distrito)->first();

            $mensaje="";
            if( $persona1->dni === $persona2->dni && $persona1->dni === $persona3->dni &&
            $persona1->dni === $persona4->dni && $persona1->dni === $persona5->dni){
             $mensaje= "Son la misma persona";
             return redirect()->route('solicitud-dni.create')->with('respuesta',$mensaje);
            }
        }catch(ModelNotFoundException $ex){
            $mensaje="Los datos no son validados";
            return redirect()->route('solicitudDNI.inicio')->with('respuesta',$mensaje);
        }
    }

    public function generaPdf($idSolicitud){
        $solicitud=SolicitudDNI::find($idSolicitud);
        $fecha = date('Y-m-d');
        $data = compact('solicitud','fecha');
        $pdf = Pdf::loadView('SolicitudDNI.dniPdf', $data);
        
        //return view('SolicitudDNI/dniPdf',compact('solicitud'));
        return $pdf->stream('dni.pdf');
    }


    public function cancelar(){
        return redirect()->route('solicitud-dni.index');
    }

}
