<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Actanacimiento;
use App\Models\Ficha;
use App\Models\Acta_Persona;
// use App\Models\Libro;
// use App\Models\Folio;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ActaNacimientoController extends Controller
{
    const PAGINATION=5;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $ActaNacimiento=Acta::select('*')
        ->join('ficha_registro as f','f.idFicha','=','Acta.idActa')
        ->join('Acta_Persona as AP','AP.idActa','=','Acta.idActa')
        ->join('Persona','Persona.DNI','=','AP.DNI')
        ->join('acta_nacimiento as an','an.idActa','=','Acta.idActa')
        ->where('f.idtipo','=',1)
        ->where('an.nombres','like','%Persona.Nombres%')
        ->where('AP.estado','=','1')->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);

       
       // $actas=Acta::select('*')->join('Ficha_registro as f','f.idficha','=','Acta.idacta')->where('f.estado','like','%pendiente%')->get();
        $fichasP = Ficha::select('*')->join('tipoficha as tf','tf.idtipo','=','ficha_registro.idtipo')->where('estado', 'Pendiente')->where('tf.nombre','=','Nacimiento')->get();
        return view('ActaNacimiento.index',compact('ActaNacimiento','buscarpor','fichasP'));
    }

    public function create(){
        //if (Auth::user()->rol=='Administrativo'){   //boton registrar
            $personas[3] = Persona::all();
            $fichasP = Ficha::all()->where('estado', 'Pendiente');
            return view('ActaNacimiento.create',compact('personas','fichasP'));
       // }else{
       //     return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
       // }
    }

    public function store(Request $request){
      
        $data=request()->validate([
            'observacion'=>'required|max:30',
            'fecha_nacimiento'=>'required',
            'lugar_nacimiento'=>'required|max:30',
           // 'archivo_nacimiento'=>'required',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Nacimiento',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            'fecha_nacimiento.required'=>'Ingrese una Fecha de la Acta de Nacimiento',
            'lugar_nacimiento.required'=>'Ingrese el lugar de Nacimiento',
            'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
           // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);

        $dniPadre=$request->dniP;
        $dniMadre=$request->dniM;
         // Buscando padres del mocoso
         $personaP=Persona::findOrFail($dniPadre);
         $personaM=Persona::findOrFail($dniMadre);
        // return $personaP;
         //-----------------------
        // persona niño
        $persona=new Persona();
        $n=strlen($request->idacta);
        $dni_niño=(String)str_pad($request->idacta,9-$n,"0",STR_PAD_RIGHT);
        $persona->DNI=$dni_niño;
        $persona->Apellido_Paterno=$personaP->Apellido_Paterno;
        $persona->Apellido_Materno=$personaM->Apellido_Paterno;
        $persona->nombres=$request->nombres;
        $persona->sexo=$request->sexo;
        $persona->fecha_nacimiento=$request->fecha_nacimiento;
        $persona->estado='1';
        $persona->direccion=$personaM->direccion;
        $persona->save();
        //----------------------------------
       
        //Creacion de acta nacimiento con su padre
        $id=$request->idacta;
     
        $Acta= Acta::findOrFail($id);
        $ActaNacimiento= new ActaNacimiento();
        $ficha=Ficha::findOrFail($id);
        $ficha->estado='Aprobado';
        $ficha->save();
        //
        //Guardado de datos de Acta
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->observacion=$request->observacion;
        $Acta->lugar_ocurrencia=$request->lugar_nacimiento;
        $Acta->estado='1';
        $Acta->nombreregistradorcivil=Auth::user()->name;
        $Acta->localidad=$request->localidad;      
        $Acta->save();

        //Guardadp de Acta Nacimiento
        $ActaNacimiento->idActa=$Acta->idActa;
        $ActaNacimiento->fecha_nacimiento=$request->fecha_nacimiento;
        $ActaNacimiento->DNIPadre=$personaP->DNI;
        $ActaNacimiento->DNIMadre=$personaM->DNI;
        $ActaNacimiento->nombres=$persona->nombres.' '.$personaP->Apellido_Paterno.' '.$personaM->Apellido_Paterno;
        $ActaNacimiento->domicilio=$personaM->direccion;
        $ActaNacimiento->sexo=$persona->sexo;
        $ActaNacimiento->save();
        //
        // if($request->hasFile('archivo_nacimiento')){
        //     $archivo=$request->file('archivo_nacimiento')->store('ArchivosNacimiento','public');
        //     $url = Storage::url($archivo);
        //     $Acta->archivo=$url;
       // }
     
       //Creacion y guardado de Acta_Persona

        $ActaPersona=new Acta_Persona();
        $ActaPersona->DNI=$dniPadre;
        $ActaPersona->idActa=$Acta->idActa;
        $ActaPersona->estado='1';
        $ActaPersona->save();
        ///
        $ActaPersona1=new Acta_Persona();
        $ActaPersona1->DNI=$dniMadre;
        $ActaPersona1->idActa=$Acta->idActa;
        $ActaPersona1->estado='1';
        $ActaPersona1->save();
        
        //
        $ActaPersona2= new Acta_Persona();
        $ActaPersona2->DNI=$dni_niño;
        $ActaPersona2->idActa=$Acta->idActa;
        $ActaPersona2->estado='1';
        $ActaPersona2->save();


        
        return redirect()->route('ActaNacimiento.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        // if (Auth::user()->rol=='Administrativo'){   //boton editar
            // $libros=Libro::all();
            // $folios=Folio::all();
            $actaNacimiento= Acta_Persona::findOrFail($id);
            $acta=Acta_Persona::findOrFail($actaNacimiento->idActa);
            $personas = Persona::findorFail($actaNacimiento->idActa);
           //$fichasP = Ficha::all()->where('estado', 'Pendiente');
            return view('ActaNacimiento.edit',compact('actaNacimiento','acta','personas'));
        // }else{
        //     return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'observacion'=>'required|max:30',
            'fecha_nacimiento'=>'required',
            'lugar_nacimiento'=>'required|max:30',
        ],
        [
            'observacion.required'=>'La observación no puede estar vacía',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            'fecha_nacimiento.required'=>'Fecha de la Acta de Nacimiento no puede estar vacía',
            'lugar_nacimiento.required'=>'El lugar de Nacimiento no puede estar vacío',
            'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
        ]);

        $ActaNacimiento=Acta_Persona::findOrFail($id);
        $ActaNacimiento->DNI=$request->dni;
        $ActaNacimiento->save();

        $Acta = Acta::findOrFail($ActaNacimiento->idActa);
        // $Acta->idLibro=$request->nroLibro;
        // $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;
        if($request->hasFile('archivo_nacimiento')){
            $archivo=$request->file('archivo_nacimiento')->store('ArchivosNacimiento','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }
        $Acta->fecha_Acta=$request->fecha_nacimiento;
        $Acta->lugar_Acta=$request->lugar_nacimiento;
        $Acta->save();

        $persona=Persona::findOrFail($request->dni);
        $persona->apellido_paterno=$request->Apellido1;
        $persona->apellido_materno=$request->Apellido2;
        $persona->nombres=$request->nombres;
        $persona->sexo=$request->sexo;
        $persona->save();

        return redirect()->route('ActaNacimiento.index')->with('datos','Registro Nuevo Actualizado ...!');
    }

    public function destroy($id){
        $ActaNacimiento=Acta_Persona::findOrFail($id);
        $persona=Persona::findOrFail($ActaNacimiento->DNI);
        $persona->estado='0';
        $persona->save();
        $ActaNacimiento->estado='0';
        $ActaNacimiento->save();

        $Acta=Acta::findOrFail($ActaNacimiento->idActa);
        $Acta->estado='0';
        $Acta->save();
        return redirect()->route('ActaNacimiento.index')->with('datos','Registro Eliminado ...!');
    }

    public function confirmar($id){
        // if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ActaNacimiento=Acta_Persona::findOrFail($id);
            $fichasP = Ficha::all()->where('estado', 'Pendiente');
            return view('ActaNacimiento.confirmar',compact('ActaNacimiento','fichasP'));
        // }else{
        //     return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function cancelar(){
        return redirect()->route('ActaNacimiento.index')->with('datos','acciona cancelada...');
    }
    public function archivo($id){
        $ActaNacimiento=Acta_Persona::findOrFail($id);
        return view('ActaNacimiento.archivo',compact('ActaNacimiento'));
    }

    public function actaGenerada($id){
        $actaPersona= Acta_Persona::findOrFail($id);
        $actaGenerada=Acta::findOrFail($actaPersona->idActa);
        $fecha = date('Y-m-d');
        $data = compact('actaGenerada','actaPersona','fecha');
        $pdf = Pdf::loadView('ActaNacimiento.actaGenerada', $data);
        return $pdf->stream('ActaNacimiento.pdf');
        //return $pdf->download('ActaNacimiento.pdf');
    }

    public function revisar($id){
        $personas= Persona::all();
       
        $ficha = Ficha::findOrFail($id);
        $fichasP = Ficha::all()->where('estado', 'Pendiente');
        return view('ActaNacimiento.create',compact('id','ficha','fichasP','personas'));
      
    }
}
