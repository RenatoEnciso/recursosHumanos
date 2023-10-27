<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Solicitud;
use App\Models\SolicitudDNI;
use DateTime;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class SolicitudDNIController extends Controller
{
    const PAGINATION=10;
    public function inicio(Request $request){
        return view('ciudadano.index');
    }

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
    
    public function edit($id){
        return view('SolicitudDNI.edit');
    }
    
    public function store(Request $request){
        $data=request()->validate([
            'DNI'=>'required',
            'file_foto'=>'required',
            'file_voucher'=>'required',
            'cod_agua'=>'required',
            'cod_luz'=>'required',
        ],
        [
            'DNI.required'=>'Ingrese Numero de DNI',
            'file_foto.required'=>'Inngrese la foto actual tamaño pasaporte',
            'file_voucher.required'=>'Ingrese un vocuher',
            'cod_agua.required'=>'Ingrese el codigo de servicio de agua',
            'cod_luz.required'=>'Ingrese el codigo de servicio de luz',
        ]);

        $persona=Persona::find($request->DNI);
        if($persona){
            $solicitud=new SolicitudDNI();
            $solicitud->idTipoSolicitud='1';
            $solicitud->DNI=$persona->DNI;
            if ($request->hasFile('file_foto')) {
                $archivoFoto = $request->file('file_foto')->store('ArchivosDNI', 'public');
                $urlFoto = Storage::url($archivoFoto);
                $solicitud->file_foto = $urlFoto;
            }
        
            if ($request->hasFile('file_voucher')) {
                $archivoVoucher = $request->file('file_voucher')->store('ArchivosDNI', 'public');
                $urlVoucher = Storage::url($archivoVoucher);
                $solicitud->file_voucher = $urlVoucher;
            }
            $solicitud->cod_servicio_agua=$request->cod_agua;
            $solicitud->cod_servicio_luz=$request->cod_luz;
            $solicitud->solComentario=$request->comentario;
            $solicitud->solEstado='Pendiente';
            $solicitud->solFecha=new DateTime();
            $solicitud->save();
            return redirect()->route('soicitud-dni.index')->with('notifica','La solicitud de DNI AZUL fue exitosa');
        }else{
            return redirect()->route('soicitud-dni.create')->with('notifica','La solicitud No pudo realizarse');
        }
    }

    public function update(Request $request, $id){
        return view('ciudadano.index');
    }
    
    public function destroy($id){
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
            'departamento.required'=>'Ingrese el departamento de nacimiento',
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

    public function cancelar(){
        return redirect()->route('solicitud-dni.index');
    }

}
