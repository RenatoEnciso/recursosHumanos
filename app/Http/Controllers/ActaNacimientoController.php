<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Persona;
use App\Models\Libro;
use App\Models\Folio;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActaNacimientoController extends Controller
{
    const PAGINATION=3;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $ActaNacimiento=Acta::select('*')
        ->join('TipoActa','TipoActa.idTipoActa','=','Acta.idTipoActa')
        ->join('Libro','Libro.idLibro','=','Acta.idLibro')
        ->join('Acta_Persona as AP','AP.idActa','=','Acta.idActa')
        ->join('Persona','Persona.DNI','=','AP.DNI')
        ->where('TipoActa.idTipoActa','=','1')
        ->where('AP.estado','=','1')
        ->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);

        return view('ActaNacimiento.index',compact('ActaNacimiento','buscarpor'));
    }

    public function create(){
        if (Auth::user()->rol=='Administrativo'){   //boton registrar
            $libros=Libro::all();
            $folios=Folio::all();
            $personas = Persona::all();
            return view('ActaNacimiento.create',compact('personas','libros','folios'));
        }else{
            return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request){
        $data=request()->validate([
            'observacion'=>'required|max:30',
            'fecha_nacimiento'=>'required',
            'lugar_nacimiento'=>'required|max:30',
            'archivo_nacimiento'=>'required',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Nacimiento',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            'fecha_nacimiento.required'=>'Ingrese una Fecha de la Acta de Nacimiento',
            'lugar_nacimiento.required'=>'Ingrese el lugar de Nacimiento',
            'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
            'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);

        $Acta=new Acta();
        // persona
        $persona=new Persona();
        $persona->dni=$request->dni;
        $persona->apellido_paterno=$request->Apellido1;
        $persona->apellido_materno=$request->Apellido2;
        $persona->nombres=$request->nombres;
        $persona->sexo=$request->sexo;
        $persona->estado='1';
        $persona->save();
        // fin
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->hora_registro=$fecha_Actual->subHour(5)->toTimeString();
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;
        if($request->hasFile('archivo_nacimiento')){
            $archivo=$request->file('archivo_nacimiento')->store('ArchivosNacimiento','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }
        $Acta->fecha_Acta=$request->fecha_nacimiento;
        $Acta->lugar_Acta=$request->lugar_nacimiento;
        $Acta->idTipoActa=1;    //tipo Nacimiento
        $Acta->estado='1';
        $Acta->save();

        $ActaNacimiento=new Acta_Persona();
        $ActaNacimiento->DNI=$request->dni;
        $ActaNacimiento->idActa=$Acta->idActa;
        $ActaNacimiento->estado='1';
        $ActaNacimiento->save();

        return redirect()->route('ActaNacimiento.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol=='Administrativo'){   //boton editar
            $libros=Libro::all();
            $folios=Folio::all();
            $actaNacimiento= Acta_Persona::findOrFail($id);
            $acta=Acta::findOrFail($actaNacimiento->idActa);
            $personas = Persona::all();
            return view('ActaNacimiento.edit',compact('actaNacimiento','acta','personas','libros','folios'));
        }else{
            return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        }
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
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
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
        if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ActaNacimiento=Acta_Persona::findOrFail($id);
            return view('ActaNacimiento.confirmar',compact('ActaNacimiento'));
        }else{
            return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function cancelar(){
        return redirect()->route('ActaNacimiento.index')->with('datos','acciona cancelada...');
    }
    public function archivo($id){
        $ActaNacimiento=Acta_Persona::findOrFail($id);
        return view('ActaNacimiento.archivo',compact('ActaNacimiento'));
    }
}
