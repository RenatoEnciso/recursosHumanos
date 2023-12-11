<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolDniPrimeraVezCreateRequest;
use App\Models\Persona;
use App\Models\SolicitudDNI;
use App\Models\RegistroDNI;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Storage;

class RegistroPrimeraController extends Controller
{
    const PAGINATION = 10;
    /* public function inicio(Request $request){
        return view('ciudadano.index');
    }*/

    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $registros = RegistroDNI::select('*')
            ->join('persona as p', 'p.DNI', '=', 'registro_dni.DNI')
            ->where('Nombres', 'like', '%' . $buscarpor . '%')
            ->paginate($this::PAGINATION);

        $solicitudes = SolicitudDNI::select('*')
            ->join('tipo_solicitud_dni as ts', 'ts.idTipoSolicitud', '=', 'solicitud_dni.idTipoSolicitud')
            ->where('solicitud_dni.solEstado', 'Pendiente')
            ->where('ts.idTipoSolicitud', 1)->get();
        return view('RegistroDNI.regPrimera.index', compact('registros', 'solicitudes', 'buscarpor'));
    }


    public function createValido(Request $request, $idSolicitud)
    {
        $solicitud = SolicitudDNI::find($idSolicitud);
        $solicitud->solEstado='En Proceso';
        $solicitud->save();
        $persona = Persona::find($solicitud->DNI_Titular);
        return view('RegistroDNI.regPrimera.create', compact('persona','solicitud'));
    }

    public function store(Request $request)
    {
        $persona = Persona::find($request->DNI);
        $solicitud=SolicitudDNI::find($request->idSolicitud);
        if ($persona) {
            $registro = new RegistroDNI();
            $registro->DNI = $request->DNI;
            $registro->idTipoDni = 1;  // 1= Primera vez
            $registro->direccion = $request->direccion;
            $registro->dniFechaEmision = $request->fecha_emision;
            $registro->dniFechaCaducidad = $request->fecha_caducidad;
            $foto = $request->file('file_foto');
            if ($foto) {
                $nombreArchivo = $registro->persona->Nombres . '.' . $foto->getClientOriginalExtension();
                Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
                $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
                $registro->file_foto = $urlFoto;
            }

            $firma = $request->file('file_firma');
            if ($firma) {
                $nombreArchivo = $registro->persona->Nombres . '.' . $firma->getClientOriginalExtension();
                Storage::put('public/primeraVez/FirmasDNI/' . $nombreArchivo, file_get_contents($firma));   //guardar en storage
                $urlfirma = Storage::url('public/primeraVez/FirmasDNI/' . $nombreArchivo);  //obtener url de foto
                $registro->file_firma = $urlfirma;
            }
            $registro->regEstado = 1;
            $registro->idSolicitudDNI = $solicitud->idSolicitud;
            $registro->regFecha = new DateTime();
            $registro->save();

            $solicitud->solEstado="Aceptado";
            $solicitud->save();
            return redirect()->route('reg-primera.index')->with('notifica', 'La solicitud de DNI AZUL fue exitosa');
        } else {
            return redirect()->route('reg-primera.create')->with('notifica', 'La solicitud No pudo realizarse');
        }
    }

    public function edit($id)
    {
        $registro = RegistroDNI::find($id);
        $solicitud = SolicitudDNI::find($registro->idSolicitudDNI);
        $persona = Persona::find($registro->DNI);
        return view('RegistroDNI.regPrimera.edit', compact('registro', 'persona','solicitud'));
    }
    
    public function update(Request $request, $id)
    {
        $registro = RegistroDNI::find($id);
        $solicitud=SolicitudDNI::find($request->idSolicitud);
        $registro->DNI = $request->DNI;
        $registro->idTipoDni = 1;  // 1= Primera vez
        $registro->direccion = $request->direccion;
        $registro->dniFechaEmision = $request->fecha_emision;
        $registro->dniFechaCaducidad = $request->fecha_caducidad;
        $foto = $request->file('file_foto');
        if ($foto) {
            $nombreArchivo = $registro->persona->Apellido_Paterno. '.' . $foto->getClientOriginalExtension();
            Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
            $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
            $registro->file_foto = $urlFoto;
        }

        $firma = $request->file('file_firma');
        if ($firma) {
            $nombreArchivo = $registro->persona->Nombres . '.' . $firma->getClientOriginalExtension();
            Storage::put('public/primeraVez/FirmasDNI/' . $nombreArchivo, file_get_contents($firma));   //guardar en storage
            $urlfirma = Storage::url('public/primeraVez/FirmasDNI/' . $nombreArchivo);  //obtener url de foto
            $registro->file_firma = $urlfirma;
        }
        $registro->regEstado = 1;
        $solicitud->solEstado="Aceptado";
        $solicitud->save();
        $registro->save();

        return redirect()->route('reg-primera.index')->with('notifica', 'La actualizacion fue exitosa'); ;
    }

    // public function review($id){
    //     $solicitud=SolicitudDNI::find($id);
    //     $fechaNac= new DateTime($solicitud->persona->fecha_nacimiento);
    //     $fechaSolicitud=new DateTime($solicitud->solFecha);    
    //     $intervalo=date_diff($fechaSolicitud,$fechaNac);
    //     $edad = $intervalo->y;
    //     if($edad <17)
    //         $condEdad='El Ciudadano aún no cumple con la edad suficiente para DNI Azul';
    //     if($edad >=17 && $edad <=20)
    //         $condEdad='El Ciudadano Cumple con la edad suficiente para obtener el DNI Azul por priemra vez';
    //     if($edad >20)
    //         $condEdad='El Ciudadano Sobre pasa la edad para tramite Normal del DNI Azul';
    //     return view('SolicitudDNI.review', compact('solicitud','edad'))->with('notifica',$condEdad);
    // }

    // public function review2(Request $request, $id){
    //     $solicitud=SolicitudDNI::find($id);

    //     if ($request->has('valida_voucher')) {
    //         $solicitud->valida_voucher=1;
    //     }else{
    //         $solicitud->valida_voucher=0;
    //     }
    //     if ($request->has('valida_foto')) {
    //         $solicitud->valida_foto=1;
    //     }else{
    //         $solicitud->valida_foto=0;
    //     }
    //     if ($request->has('valida_serv_agua')) {
    //         $solicitud->valida_serv_agua=1;
    //     }else{
    //         $solicitud->valida_serv_agua=0;
    //     }
    //     if ($request->has('valida_serv_luz')) {
    //         $solicitud->valida_serv_luz=1;
    //     }else{
    //         $solicitud->valida_serv_luz=0;
    //     }

    //     $solicitud->save();
    //     return redirect()->route('reg-primera.index');
    // }


    // public function destroy($id){
    //     $solicitud=SolicitudDNI::find($id);
    //     $solicitud->delete();
    //     return view('ciudadano.index');
    // }


    // public function validar(Request $request){
    //     $request->validate([
    //         'dni' => 'required',
    //         'fechaNacimiento' => 'required|date',
    //         'departamento' => 'required',
    //         'provincia' => 'required',
    //         'distrito' => 'required'
    //     ],
    //     [
    //         'dni.required'=>'Ingrese el Numero de DNI',
    //         'fechaNacimiento.required'=>'Ingrese una Fecha de Nacimiento',
    //         'departamento.required'=>'Ingrese el departamento de
    //          nacimiento',
    //         'provincia.required'=>'Ingrese la provincia de nacimiento',
    //         'distrito.required'=>'Ingrese el distrito de nacimiento',
    //     ]);

    //     try{
    //         $persona1 = Persona::findOrFail($request->dni);
    //         $persona2 = Persona::where('fecha_nacimiento',$request->fechaNacimiento)->first();
    //         $persona3 = Persona::where('departamento',$request->departamento)->first();
    //         $persona4 = Persona::where('provincia',$request->provincia)->first();
    //         $persona5 = Persona::where('distrito',$request->distrito)->first();

    //         $mensaje="";
    //         if( $persona1->dni === $persona2->dni && $persona1->dni === $persona3->dni &&
    //         $persona1->dni === $persona4->dni && $persona1->dni === $persona5->dni){
    //          $mensaje= "Son la misma persona";
    //          return redirect()->route('reg-primera.create')->with('respuesta',$mensaje);
    //         }
    //     }catch(ModelNotFoundException $ex){
    //         $mensaje="Los datos no son validados";
    //         return redirect()->route('solicitudDNI.inicio')->with('respuesta',$mensaje);
    //     }
    // }

    public function generaPdf($idRegistro){
        $registro=RegistroDNI::find($idRegistro);
        $primer_apellido=$registro->Persona->Apellido_Paterno;
        $nombres=$registro->Persona->Nombres;
        $pos_2do=strpos($nombres," ");
        $primer_nombre=substr($nombres,0,$pos_2do-1);
        $segundo_nombre=substr($nombres,$pos_2do);
        $linea_detalle=$primer_apellido."<<".$primer_nombre."<".$segundo_nombre;

        for($i=1;$i<=30;$i++){
            if(strlen($linea_detalle)<$i){
                $linea_detalle= $linea_detalle."<";
            }
        }
        $fecha = date('Y-m-d');
        $data = compact('registro','fecha','linea_detalle');
        $pdf = Pdf::loadView('RegistroDNI.regPrimera.dniPdf', $data);

        //return view('SolicitudDNI/dniPdf',compact('solicitud'));
        return $pdf->stream('dni.pdf');
    }


    public function cancelar()
    {
        return redirect()->route('reg-primera.index');
    }
    public function cancelarRegistro($idSolicitud)
    {
        $registro = new RegistroDNI();
        $solicitud=SolicitudDNI::find($idSolicitud);
        $registro->DNI=$solicitud->DNI_Titular;
        $registro->idTipoDni=1;
        $registro->idSolicitudDNI=$solicitud->idSolicitud;
        $registro->regEstado=0;
        $registro->save();
        return redirect()->route('reg-primera.index');
    }
}
