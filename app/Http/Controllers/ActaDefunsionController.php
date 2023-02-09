<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Persona;
use App\Models\Libro;
use App\Models\Folio;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActaDefunsionController extends Controller
{
    const PAGINATION=5;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $ActaDefunsion=Acta::select('*')
        ->join('TipoActa','TipoActa.idTipoActa','=','Acta.idTipoActa')
        ->join('Libro','Libro.idLibro','=','Acta.idLibro')
        ->join('Acta_Persona as AP','AP.idActa','=','Acta.idActa')
        ->join('Persona','Persona.DNI','=','AP.DNI')
        ->where('TipoActa.idTipoActa','=','3')
        ->where('AP.estado','=','1')->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('ActaDefunsion.index',compact('ActaDefunsion','buscarpor'));
    }

    public function create(){
        if (Auth::user()->rol=='Administrativo'){   //boton registrar
            $libros=Libro::all();
            $folios=Folio::all();
            $personas = Persona::all();
            return view('ActaDefunsion.create',compact('personas','libros','folios'));
        }else{
            return redirect()->route('ActaDefunsion.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function store(Request $request){
        $data=request()->validate([
            'observacion'=>'required|max:30',
            'fecha'=>'required',
            'lugar'=>'required|max:30',
            'archivo_defunsion'=>'required',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Defunsion',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            'fecha.required'=>'Ingrese una Fecha de la Acta de Defunsion',
            'lugar.required'=>'Ingrese el lugar de Defuncion',
            'lugar.max'=>'Máximo 30 carácteres para el lugar de Extraccion',
            'archivo_defunsion.required'=>'Ingrese el archivo de la Acta de Defunsion',
        ]);


        $Acta=new Acta();
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->hora_registro=$fecha_Actual->subHour(5)->toTimeString();
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;
        if($request->hasFile('archivo_defunsion')){
            $archivo=$request->file('archivo_defunsion')->store('ArchivosDefunsion','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }
        $Acta->fecha_Acta=$request->fecha;
        $Acta->lugar_Acta=$request->lugar;
        $Acta->idTipoActa=3;    //tipo: Defunsion
        $Acta->estado='1';
        $Acta->save();

        $persona = Persona::findOrFail($request->dniPersona);
        $persona->estado='0';
        $persona->save();

        $ActaDefunsion=new Acta_Persona();
        $ActaDefunsion->DNI=$persona->DNI;
        $ActaDefunsion->idActa=$Acta->idActa;
        $ActaDefunsion->estado=1;
        $ActaDefunsion->save();

        return redirect()->route('ActaDefunsion.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol=='Administrativo'){   //boton editar
            $libros=Libro::all();
            $folios=Folio::all();
            $actaDefunsion= Acta_Persona::findOrFail($id);
            $acta=Acta::findOrFail($actaDefunsion->idActa);
            $personas = Persona::all();
            return view('ActaDefunsion.edit',compact('actaDefunsion','acta','personas','libros','folios'));
        }else{
            return redirect()->route('ActaDefunsion.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'observacion'=>'required|max:30',
            'fecha'=>'required',
            'lugar'=>'required|max:30',
        ],
        [
            'observacion.required'=>'Ingrese Observacion de la Acta de Defunsion',
            'observacion.max'=>'Máximo 30 carácteres para la Observacion',
            'fecha.required'=>'Ingrese una Fecha de la Acta de Defunsion',
            'lugar.required'=>'Ingrese el lugar de Defuncion',
            'lugar.max'=>'Máximo 30 carácteres para el lugar de Extraccion',
        ]);

        $ActaDefunsion=Acta_Persona::findOrFail($id);
        $ActaDefunsion->DNI=$request->dniPersona;
        $ActaDefunsion->save();

        $Acta = Acta::findOrFail($ActaDefunsion->idActa);
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;
        if($request->hasFile('archivo_defunsion')){
            $archivo=$request->file('archivo_defunsion')->store('ArchivosDefunsion','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }
        $Acta->fecha_Acta=$request->fecha;
        $Acta->lugar_Acta=$request->lugar;
        $Acta->save();

        $persona = Persona::findOrFail($request->dniPersona);
        $persona->estado='0';
        $persona->save();


        return redirect()->route('ActaDefunsion.index')->with('datos','Registro Nuevo Actualizado ...!');
    }

    public function destroy($id){
        $ActaDefunsion=Acta_Persona::findOrFail($id);
        $ActaDefunsion->estado='0';
        $ActaDefunsion->save();

        $persona = Persona::findOrFail($ActaDefunsion->Persona->DNI);
        $persona->estado=1;
        $persona->save();

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
}
