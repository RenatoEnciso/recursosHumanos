<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\TipoFicha;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
Date_default_timezone_set("America/Lima");

class FichaController extends Controller
{
    const PAGINATION=5;
    public function index(Request $request)
    {
        $buscarpor= $request->get('buscarpor');
        $fichas=Ficha::select('*')
        ->join('tipoficha as TF','TF.idtipo','=','ficha_registro.idtipo')
        ->where('nombre','like','%'.$buscarpor.'%')
        ->paginate($this::PAGINATION);
        return view('Ficha.index',compact('fichas','buscarpor'));
    }

    public function create(){
        $tipoFichas = TipoFicha::all();
        //$fecha_actual=date_create("America/Lima");
        $fecha_actual=Carbon::now();
        return view('Ficha.create',compact('tipoFichas','fecha_actual'));
    }

    public function store(Request $request){
        $data=request()->validate([
            'fecha_registro'=>'required',
            'tipoFicha'=>'required',
            'archivo_certificado'=>'required',
        ],
        [
            'tipoFicha.required'=>'Ingrese Observacion de la Acta de Nacimiento',
            'fecha_registro.required'=>'Ingrese una Fecha',
            'archivo_certificado.required'=>'Ingrese el certificado',
        ]);

        $ficha=new Ficha();
        $ficha->fecha_registro=$request->fecha_registro;
        if($request->hasFile('archivo_certificado')){
            $archivo=$request->file('archivo_certificado')->store('ArchivosNacimiento','public');
            $url = Storage::url($archivo);
            $ficha->ruta_certificado=$url;
        }
        $ficha->idtipo=$request->tipoFicha;
        $ficha->save();
        return redirect()->route('Ficha.index')->with('datos','Ficha Nuevo Guardado ...!');
    }

    
    

    public function edit($id){
            $ficha=Ficha::findOrFail($id);
            $tipoFichas = TipoFicha::all();
            return view('Ficha.edit',compact('ficha','tipoFichas'));
    }

    
    /*
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
        if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ActaNacimiento=Acta_Persona::findOrFail($id);
            return view('ActaNacimiento.confirmar',compact('ActaNacimiento'));
        }else{
            return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        }
    }*/

    public function cancelar(){
        return redirect()->route('Ficha.index')->with('datos','acciona cancelada...');
    }


}
