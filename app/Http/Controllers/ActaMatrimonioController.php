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

class ActaMatrimonioController extends Controller
{
    const PAGINATION=5;

    public function index(Request $request){
        $buscarpor= $request->get('buscarpor');
        $ActaMatrimonio=Acta_Persona::select('*')
        ->join('Acta','Acta.idActa','=','Acta_Persona.idActa')
        ->join('TipoActa','TipoActa.idTipoActa','=','Acta.idTipoActa')
        ->join('Libro','Libro.idLibro','=','Acta.idLibro')
        ->join('Persona','Persona.DNI','=','Acta_Persona.DNI')
        ->where('TipoActa.idTipoActa','=','2')
        ->where('Acta_Persona.estado','=','1')
        ->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('ActaMatrimonio.index',compact('ActaMatrimonio','buscarpor'));
    }

    public function create(){
        if (Auth::user()->rol=='Administrativo'){   //boton registrar
            $libros=Libro::all();
            $folios=Folio::all();
            $personas = Persona::all();
            return view('ActaMatrimonio.create',compact('personas','libros','folios'));
        }else{
            return redirect()->route('ActaMatrimonio.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function store(Request $request){
        $data=request()->validate([
           'Observacion'=>'max:40',
           'lugar_matrimonio'=>'max:30'
        ],
        [
            'Observacion.max'=>'Maximo 40 caracteres',
            'lugar_matrimonio.max'=>'Maximo 30 caracteres'
        ]);

        $Acta=new Acta();
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->hora_registro=$fecha_Actual->subHour(5)->toTimeString();
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;

        if($request->hasFile('archivo_matrimonio')){
            $archivo=$request->file('archivo_matrimonio')->store('Archivosmatrimonio','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }

        $Acta->fecha_Acta=$request->fecha_matrimonio;
        $Acta->lugar_Acta=$request->lugar_matrimonio;
        $Acta->idTipoActa=2;    //tipo matrimonio
        $Acta->estado='1';
        $Acta->save();

        $persona1 = Persona::findOrFail($request->esposa);
        $persona2 = Persona::findOrFail($request->esposo);

        $ActaMatrimonio=new Acta_Persona();
        $ActaMatrimonio->DNI=$persona1->DNI;
        $ActaMatrimonio->idActa=$Acta->idActa;
        $ActaMatrimonio->estado='1';
        $ActaMatrimonio->save();

        $ActaMatrimonio=new Acta_Persona();
        $ActaMatrimonio->DNI=$persona2->DNI;
        $ActaMatrimonio->idActa=$Acta->idActa;
        $ActaMatrimonio->estado='1';
        $ActaMatrimonio->save();

        return redirect()->route('ActaMatrimonio.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol=='Administrativo'){   //boton editar
            $libros=Libro::all();
            $folios=Folio::all();
            $personas = Persona::all();
            $ActaMatrimonio1=Acta_Persona::findOrFail($id);
            $ActaMatrimonio2=Acta_Persona::findOrFail($id+1);
            $acta=Acta::findOrFail($ActaMatrimonio1->idActa);
            return view('ActaMatrimonio.edit',compact('acta','ActaMatrimonio1','ActaMatrimonio2','personas','libros','folios'));
        }else{
            return redirect()->route('ActaMatrimonio.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'Observacion'=>'max:40',
           'lugar_matrimonio'=>'max:30'
        ],
        [
            'Observacion.max'=>'Maximo 40 caracteres',
            'lugar_matrimonio.max'=>'Maximo 30 caracteres'
        ]);
        $ActaMatrimonio1=Acta_Persona::findOrFail($id);
        $ActaMatrimonio2=Acta_Persona::findOrFail($id+1);
        $ActaMatrimonio1->DNI=$request->esposa;
        $ActaMatrimonio2->DNI=$request->esposo;
        $ActaMatrimonio1->save();
        $ActaMatrimonio2->save();

        //Modificamos el acta
        $Acta = Acta::findOrFail($ActaMatrimonio1->idActa);
        $Acta->idLibro=$request->nroLibro;
        $Acta->idFolio=$request->nroFolio;
        $Acta->observacion=$request->observacion;

        if($request->hasFile('archivo_matrimonio')){
            $archivo=$request->file('archivo_matrimonio')->store('Archivosmatrimonio','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        }

        $Acta->fecha_Acta=$request->fecha_matrimonio;
        $Acta->lugar_Acta=$request->lugar_matrimonio;
        $Acta->save();

        return redirect()->route('ActaMatrimonio.index')->with('datos','Registro Nuevo Actualizado ...!');
    }

    public function destroy($id){
        $ActaMatrimonio=Acta_Persona::findOrFail($id);
        $ActaMatrimonio->estado='0';
        $ActaMatrimonio->save();

        $ActaMatrimonio=Acta_Persona::findOrFail($id+1);
        $ActaMatrimonio->estado='0';
        $ActaMatrimonio->save();

        $Acta=Acta::findOrFail($ActaMatrimonio->idActa);
        $Acta->estado='0';
        $Acta->save();
        return redirect()->route('ActaMatrimonio.index')->with('datos','Registro Eliminado ...!');
    }

    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ActaMatrimonio=Acta_Persona::findOrFail($id);
            return view('ActaMatrimonio.confirmar',compact('ActaMatrimonio'));
        }else{
            return redirect()->route('ActaMatrimonio.index')->with('datos','..::No tiene Acceso ..::');
        }

    }

    public function archivo($id){
        $ActaMatrimonio=Acta_Persona::findOrFail($id);
        return view('ActaMatrimonio.archivo',compact('ActaMatrimonio'));
    }

    public function cancelar(){
        return redirect()->route('ActaMatrimonio.index')->with('datos','acciona cancelada...');
    }
}
