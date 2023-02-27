<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Defunsion;
use App\Models\Acta_Persona;
use App\Models\Persona;

// use App\Models\Libro;
// use App\Models\Folio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ficha;

class ActaDefunsionController extends Controller
{
    const PAGINATION=5;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $ActaDefunsion=Acta::select('*')
        ->join('ficha_registro as f','f.idFicha','=','Acta.idActa')
        ->join('Acta_Persona as AP','AP.idActa','=','Acta.idActa')
        ->join('Persona','Persona.DNI','=','AP.DNI')
        ->where('f.idtipo','=',3)
        ->where('AP.estado','=','1')->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        // ->where('ficha_registro.idtipo','=','3') d
        ->paginate($this::PAGINATION);
        $fichasP = Ficha::all()->where('estado', 'Pendiente')->where('idtipo','=',3);
        // return $ActaDefunsion;
        // return $ActaDefunsion;
        return view('ActaDefunsion.index',compact('ActaDefunsion','buscarpor','fichasP'));
    }

    public function create(){
        // if (Auth::user()->rol=='Administrativo'){   //boton registrar
            // $libros=Libro::all();
            // $folios=Folio::all();
            // $fichasP = Ficha::all()->where('estado', 'Pendiente');
            $personas = Persona::all();
            return view('ActaDefunsion.create',compact('personas'));
        // }else{
        //     return redirect()->route('ActaDefunsion.index')->with('datos','..::No tiene Acceso ..::');
        // }

    }

    public function store(Request $request){
        // return $request->all();
        $data=request()->validate([
            'observacion'=>'required|max:30',
            // 'fecha'=>'required',
            // 'lugar'=>'required|max:30',
            // 'archivo_defunsion'=>'required',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Defunsion',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            // 'fecha.required'=>'Ingrese una Fecha de la Acta de Defunsion',
            // 'lugar.required'=>'Ingrese el lugar de Defuncion',
            // 'lugar.max'=>'Máximo 30 carácteres para el lugar de Extraccion',
            // 'archivo_defunsion.required'=>'Ingrese el archivo de la Acta de Defunsion',
        ]);

 
        // $Acta->idLibro=$request->nroLibro;
        // $Acta->idFolio=$request->nroFolio;


        // general
        // return $request->all();
        $id=$request->idActa;
       
        $Acta= Acta::findOrFail($id);
        // return $Acta;
        // 
        $ficha=Ficha::findOrFail($id);
        $ficha->estado='Aprobado';
        $ficha->save();
        
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->observacion=$request->observacion;
        $Acta->lugar_ocurrencia=$request->lugar_ocurrencia;
        $Acta->localidad=$request->localidad;
        $Acta->nombreRegistradorCivil=Auth::user()->name;
        // if($request->hasFile('archivo_defunsion')){
        //     $archivo=$request->file('archivo_defunsion')->store('ArchivosDefunsion','public');
        //     $url = Storage::url($archivo);
        //     $Acta->archivo=$url;
        // }
        $Acta->estado='1';
        $Acta->save();
       
        // defuncion
        // 
        
        $persona = Persona::findOrFail($request->dniPersona);
        
        $persona->estado='0';
        $persona->save();
        
        $familiar = Persona::findOrFail($request->dniFamiliar);
        
        
        
        
        // ACTA_PERSONA
        $ActaFallecido=new Acta_Persona();
        $ActaFallecido->DNI=$persona->DNI;
        $ActaFallecido->idActa=$Acta->idActa;
        $ActaFallecido->estado=1;
        $ActaFallecido->save();
        $ActaRepresentante=new Acta_Persona();
        $ActaRepresentante->DNI=$familiar->DNI;
        $ActaRepresentante->idActa=$Acta->idActa;
        $ActaRepresentante->estado=1;
        $ActaRepresentante->save();

        // DEFUNCION TABLA
        // fecha_fallecido	edad	lugarNacimiento	dniFallecido		nombreDeclarante	firma_declarante	
        $ActaDefunsion=new Acta_Defunsion();
           
        $ActaDefunsion->idActa=$id;
        $ActaDefunsion->fecha_fallecido=$request->fecha_fallecido;
        // return $request->fecha_fallecido;
        $ActaDefunsion->nombreDeclarante=$familiar->Nombres ." ". $familiar->Apellido_Paterno ." ". $familiar->Apellido_Materno;
        $ActaDefunsion->edad=$fecha_Actual->diffInYears($persona->fecha_nacimiento);
        if($request->hasFile('archivo_firma_declarante')){
            $archivo=$request->file('archivo_firma_declarante')->store('ArchivosDefunsion','public');
            $url = Storage::url($archivo);
            $ActaDefunsion->firma_declarante=$url;
        }
        
        $ActaDefunsion->dniFallecido=$persona->DNI;
        $ActaDefunsion->save();
        return redirect()->route('ActaDefunsion.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol=='Administrativo'){   //boton editar
            // $libros=Libro::all();
            // $folios=Folio::all();
            $actaDefunsion= Acta_Persona::findOrFail($id);
            $actaDefunsion2=Acta_Persona::findOrFail($id+1);
            $acta=Acta::findOrFail($actaDefunsion->idActa);
            $personas = Persona::all();
            return view('ActaDefunsion.edit',compact('actaDefunsion','actaDefunsion2','acta','personas'));
        }else{
            return redirect()->route('ActaDefunsion.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'observacion'=>'required|max:30',
            // 'fecha'=>'required',
            // 'lugar'=>'required|max:30',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Defunsion',
            // 'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            // 'fecha.required'=>'Ingrese una Fecha de la Acta de Defunsion',
            // 'lugar.required'=>'Ingrese el lugar de Defuncion',
            // 'lugar.max'=>'Máximo 30 carácteres para el lugar de Extraccion',
        ]);
        
        $ActaDefunsion=Acta_Persona::findOrFail($id);
        $ActaDefunsion->DNI=$request->dniPersona;
        $ActaDefunsion->save();
        $actaDefunsion2=Acta_Persona::findOrFail($id+1);
        $ActaDefunsion2->DNI=$request->dniFamiliar;
        $ActaDefunsion2->save();

        $Acta = Acta::findOrFail($ActaDefunsion->idActa);
        // $Acta->idLibro=$request->nroLibro;
        // $Acta->idFolio=$request->nroFolio;
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->observacion=$request->observacion;
        $Acta->lugar_ocurrencia=$request->lugar_ocurrencia;
        $Acta->localidad=$request->localidad;
        $Acta->nombreRegistradorCivil=Auth::user()->name;
        // if($request->hasFile('archivo_defunsion')){
        //     $archivo=$request->file('archivo_defunsion')->store('ArchivosDefunsion','public');
        //     $url = Storage::url($archivo);
        //     $Acta->archivo=$url;
        // }
        $Acta->estado='1';
        $Acta->save();

        $persona = Persona::findOrFail($request->dniPersona);
        $persona->estado='0';
        $persona->save();

        $ActaDefunsion=Acta_Defunsion::findOrFail($ActaDefunsion->idActa);
        $ActaDefunsion->fecha_fallecido=$request->fecha_fallecido;
        // return $request->fecha_fallecido;
        $ActaDefunsion->nombreDeclarante=$familiar->Nombres ." ". $familiar->Apellido_Paterno ." ". $familiar->Apellido_Materno;
        $ActaDefunsion->edad=$fecha_Actual->diffInYears($persona->fecha_nacimiento);
        if($request->hasFile('archivo_firma_declarante')){
            $archivo=$request->file('archivo_firma_declarante')->store('ArchivosDefunsion','public');
            $url = Storage::url($archivo);
            $ActaDefunsion->firma_declarante=$url;
        }
        
        $ActaDefunsion->dniFallecido=$persona->DNI;
        $ActaDefunsion->save();
        return redirect()->route('ActaDefunsion.index')->with('datos','Registro Nuevo Actualizado ...!');
    }

    public function destroy($id){
        $ActaDefunsion=Acta_Persona::findOrFail($id);
        $ActaDefunsion->estado='0';
        $ActaDefunsion->save();

        $persona = Persona::findOrFail($ActaDefunsion->Persona->DNI);
        $persona->estado=1;
        $persona->save();

        $actaDefunsion2=Acta_Persona::findOrFail($id+1);
        $ActaDefunsion->estado='0';
        $ActaDefunsion2->save();

        $Acta=Acta::findOrFail($ActaDefunsion->idActa);
        $Acta->estado='0';
        $Acta->save();
        return redirect()->route('ActaDefunsion.index')->with('datos','Registro Eliminado ...!');
    }

    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ActaDefunsion=Acta_Persona::findOrFail($id);
            return view('ActaDefunsion.confirmar',compact('ActaDefunsion'));
        }else{
            return redirect()->route('ActaDefunsion.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function archivo($id){
        $ActaDefunsion=Acta_Persona::findOrFail($id);
        return view('ActaDefunsion.archivo',compact('ActaDefunsion'));
    }

    public function cancelar(){
        return redirect()->route('ActaDefunsion.index')->with('datos','acciona cancelada...');
    }

    public function actaGenerada($id){
        $actaPersona= Acta_Persona::findOrFail($id);
        $actaGenerada=Acta::findOrFail($actaPersona->idActa);
        $fecha = date('Y-m-d');
        $data = compact('actaGenerada','actaPersona','fecha');
        $pdf = Pdf::loadView('ActaDefunsion.actaGenerada', $data);
        //return $pdf->stream('ActaDefuncion.pdf');
        return $pdf->download('ActaDefuncion.pdf');
    }
    public function revisar($id){
        $ficha = Ficha::findOrFail($id);
        $fichasP = Ficha::all()->where('estado', 'Pendiente');
        $personas = Persona::all();
        return view('ActaDefunsion.create',compact('id','ficha','fichasP','personas'));
      
    }
}
