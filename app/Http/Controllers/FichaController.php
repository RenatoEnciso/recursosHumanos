<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\TipoFicha;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Acta;
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

        $numPendientes = Ficha::all()->where('estado', 'Pendiente')->count();
        return view('Ficha.index',compact('fichas','buscarpor','numPendientes'));
    }

    public function create(){
        $tipoFichas = TipoFicha::all();
        $fecha_actual=Carbon::now();
        return view('Ficha.create',compact('tipoFichas','fecha_actual'));
    }

    public function crearActa($id){
        $ficha = Ficha::findOrFail($id);
        $tipoActa=$ficha->idtipo;
       
        if($tipoActa==1){
            return redirect()->route('ActaNacimiento.create');
        }
        if($tipoActa==2){
            return redirect()->route('ActaMatrimonio.create');
        }else{
            return redirect()->route('ActaDefunsion.create');
        } 
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
            $archivo=$request->file('archivo_certificado')->store('ArchivosCertificados','public');
            $url = Storage::url($archivo);
            $ficha->ruta_certificado=$url;
        }
        $ficha->idtipo=$request->tipoFicha;
        $ficha->estado="Pendiente";
        $ficha->save();
        $acta=new Acta();
       // return $ficha;
        $acta->idacta=$ficha->idficha;
        $acta->save();
        return redirect()->route('Ficha.index')->with('datos','Ficha Nuevo Guardado ...!');
    }

    public function edit($id){
        $ficha=Ficha::findOrFail($id);
        $tipoFichas = TipoFicha::all();
        return view('Ficha.edit',compact('ficha','tipoFichas'));
    }

   
    public function update(Request $request, $id)
    {
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

        $ficha=Ficha::findOrFail($id);
        $ficha->fecha_registro=$request->fecha_registro;
        if($request->hasFile('archivo_certificado')){
            $archivo=$request->file('archivo_certificado')->store('ArchivosCertificados','public');
            $url = Storage::url($archivo);
            $ficha->ruta_certificado=$url;
        }
        $ficha->idtipo=$request->tipoFicha;
        $ficha->save();
        return redirect()->route('Ficha.index')->with('datos','Ficha Actualizado ...!');

    }

    public function destroy($id){
        $ficha=Ficha::findOrFail($id);
        $ficha->delete();   //Elimina

        return redirect()->route('Ficha.index')->with('datos','Registro Eliminado ...!');
    }

    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){   //boton eliminar
            $ficha=Ficha::findOrFail($id);
            return view('Ficha.confirmar',compact('ficha'));
        }else{
            return redirect()->route('ActaNacimiento.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function cancelar(){
        return redirect()->route('Ficha.index')->with('datos','acciona cancelada...');
    }


}
