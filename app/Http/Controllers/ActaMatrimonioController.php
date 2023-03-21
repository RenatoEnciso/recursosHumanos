<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Acta_Matrimonio;
use App\Models\Acta_Persona;
use App\Models\Ficha;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ActaMatrimonioController extends Controller
{
    const PAGINATION=5;

    public function index(Request $request){
        $buscarpor= $request->get('buscarpor');
        $ActaMatrimonio=Acta_Persona::select('*')
        ->join('Acta','Acta.idActa','=','Acta_Persona.idActa')
        ->join('ficha_registro','ficha_registro.idficha','=','Acta.idActa')//filtrado
        ->join('Persona','Persona.DNI','=','Acta_Persona.DNI')
        ->where('Acta_Persona.estado','=','1')
        ->where('Persona.Apellido_Paterno','like','%'.$buscarpor.'%')
        ->where('ficha_registro.idtipo','=','2')
        ->paginate($this::PAGINATION);
        $fichasP = Ficha::select('*')->join('tipoficha as tf','tf.idtipo','=','ficha_registro.idtipo')->where('estado', 'Pendiente')->where('tf.nombre','=','Matrimonio')->get();
        return view('ActaMatrimonio.index',compact('ActaMatrimonio','buscarpor','fichasP'));
    }

    public function revisar($id){
        //if (Auth::user()->rol=='Administrativo'){   //boton registrar
            $personas = Persona::all();
            $ficha=Ficha::findOrFail($id);
            $fichasP = Ficha::all()->where('estado', 'Pendiente')->where('tf.nombre','=','Matrimonio');
            return view('ActaMatrimonio.create',compact('personas','id','fichasP','ficha'));
       // }else{
        //    return redirect()->route('ActaMatrimonio.index')->with('datos','..::No tiene Acceso ..::');
       // }
    }

    public function store(Request $request/* , $idActa */){
        $data=request()->validate([
           'Observacion'=>'max:40',
           'lugar_matrimonio'=>'max:30'
        ],
        [
            'Observacion.max'=>'Maximo 40 caracteres',
            'lugar_matrimonio.max'=>'Maximo 30 caracteres'
        ]);

        $id=$request->idActa;
        $Acta= Acta::findOrFail($id);
        //return $Acta;
        $ficha=Ficha::findOrFail($id);
        $ficha->estado='Aprobado';
        $ficha->save();

        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        //$Acta->hora_registro=$fecha_Actual->subHour(5)->toTimeString();
        $Acta->observacion=$request->observacion;

        /* if($request->hasFile('archivo_matrimonio')){
            $archivo=$request->file('archivo_matrimonio')->store('Archivosmatrimonio','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        } */

        //$Acta->fecha_Acta=$request->fecha_matrimonio;
        $Acta->lugar_ocurrencia=$request->lugar_matrimonio;
        //$Acta->TipoActa=2;    //tipo matrimonio
        $Acta->estado='1';
        $Acta->nombreRegistradorCivil=Auth::user()->name;
        $Acta->save();

        $persona1 = Persona::findOrFail($request->esposa);
        $persona2 = Persona::findOrFail($request->esposo);

        $Esposa=new Acta_Persona();
        $Esposa->DNI=$persona1->DNI;
        $Esposa->idActa=$id;
        $Esposa->estado='1';
        $Esposa->funcion='Esposa';
        $Esposa->save();

        $Esposo=new Acta_Persona();
        $Esposo->DNI=$persona2->DNI;
        $Esposo->idActa=$id;
        $Esposo->estado='1';
        $Esposo->funcion='Esposo';
        $Esposo->save();

        $ActaMatrimonio = new Acta_Matrimonio();
        $ActaMatrimonio->fecha_matrimonio=$request->fecha_matrimonio;
        $ActaMatrimonio->idActa=$id;
        $ActaMatrimonio->DNIEsposo = $persona2->DNI;
        $ActaMatrimonio->DNIEsposa = $persona1->DNI;
        $ActaMatrimonio->save();

        return redirect()->route('ActaMatrimonio.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function edit($id){
        if (Auth::user()->rol->nombreRol=='Registrador'){   //boton editar
            $personas = Persona::all();
            $ActaMatrimonio1=Acta_Persona::findOrFail($id);
            $ActaMatrimonio2=Acta_Persona::findOrFail($id+1);
            $acta=Acta::findOrFail($ActaMatrimonio1->idActa);
            $fichasP = Ficha::all()->where('estado', 'Pendiente');
            return view('ActaMatrimonio.edit',compact('acta','ActaMatrimonio1','ActaMatrimonio2','personas','fichasP'));
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
        $esposa=Acta_Persona::findOrFail($id);
        $esposo=Acta_Persona::findOrFail($id+1);
        $esposa->DNI=$request->esposa;
        $esposo->DNI=$request->esposo;
        $esposa->save();
        $esposo->save();

        //Modificamos el acta
        $Acta = Acta::findOrFail($esposa->idActa);
        $fecha_Actual=Carbon::now();
        $Acta->fecha_registro=$fecha_Actual;
        $Acta->observacion=$request->observacion;
        $Acta->lugar_ocurrencia=$request->lugar_matrimonio;
        $Acta->nombreRegistradorCivil=Auth::user()->name;
        $Acta->save();

        $ActaMatrimonio = Acta_Matrimonio::findOrFail($esposa->idActa);
        $ActaMatrimonio->fecha_matrimonio=$request->fecha_matrimonio;
        $ActaMatrimonio->DNIEsposo = $request->esposo;
        $ActaMatrimonio->DNIEsposa = $request->esposa;
        $ActaMatrimonio->save();

        /* if($request->hasFile('archivo_matrimonio')){
            $archivo=$request->file('archivo_matrimonio')->store('Archivosmatrimonio','public');
            $url = Storage::url($archivo);
            $Acta->archivo=$url;
        } */

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
        if (Auth::user()->rol->nombreRol=='Registrador'){   //boton eliminar
            $ActaMatrimonio=Acta_Persona::findOrFail($id);
            $ActasMatrimonio=Acta_Persona::all();
            return view('ActaMatrimonio.confirmar',compact('ActaMatrimonio','ActasMatrimonio'));
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

    public function actaGenerada($id){
       
        
        $actaPersona= Acta_Persona::select('*')->where('idActa','=',$id)->get();
        
        $actaGenerada=Acta::findOrFail($id);
        $fecha = date('Y-m-d');
        $data = compact('actaGenerada','actaPersona','fecha');
        //return $data;
        $pdf = Pdf::loadView('ActaMatrimonio.actaGenerada', $data);
        //return $pdf->stream('ActaMatrimonio.pdf');
        return $pdf->download('ActaMatrimonio.pdf');

    }
}
