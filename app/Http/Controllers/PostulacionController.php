<?php

namespace App\Http\Controllers;



// use App\Models\Postulacion;
use App\Models\Persona;
use App\Models\Oferta;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class PostulacionController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        Postulacion::all();
        $Postulacions=Postulacion::select('idPostulacion','Postulacion.DNI','Postulacion.idOferta','fecha','p.Nombres','Postulacion.idPostulacion','curriculum','Postulacion.estado')
        ->join('Persona as p','p.DNI','=','Postulacion.DNI')
        ->join('Oferta as o','o.idOFerta','=','Postulacion.idOFerta')
        
        ->where('p.Nombres','like','%'.$busqueda.'%')
        ->where('Postulacion.estado','=',1)
        ->distinct()
        ->paginate($this::PAGINATION);
        return view('Postulacion.index',compact('Postulacions','busqueda'));
    }

    public function indexP(Request $request){
        $busqueda=$request->get('buscarpor');
        // return "hola";
        // $busqueda=$id;
        $Ofertas=Oferta::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Externo.Trabajar',compact('Ofertas','busqueda'));
    }


    public function createP($id)
    {
        // if (Auth::user()->Postulacion=='Encargado contrato'){   //boteon registrar
            $personas = Persona::all();
            $oferta = Oferta::findOrFail($id);
            $ofertas = Oferta::all();
            return view('Externo.createP',compact('personas','oferta','ofertas'));
        // } else{
        //     return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }
    public function create()
    {
        // if (Auth::user()->Postulacion=='Encargado contrato'){   //boteon registrar
            $personas = Persona::all();
            $ofertas = Oferta::all();
            return view('Postulacion.create',compact('personas','ofertas'));
        // } else{
        //     return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                'idOferta' => 'required|exists:oferta,idOferta',
                'fecha' => 'required|date',
                'email' => 'required',
                'telefono' => 'required|numeric',
                'titulo' => 'required|string',
                'pais' => 'required|string',
                'institucion' => 'required|string',
                'areaEstudio' => 'required|string',
                'nivelEstudio' => 'required|string',
                'estadoEstudio' => 'required|string',
                    ]);
               
                    $Postulacion=new Postulacion();
                    $Postulacion->DNI=$request->DNI;
                    $Postulacion->idOferta=$request->idOferta;
                    $Postulacion->fecha=$request->fecha;

                    if($request->hasFile('curriculum')){
                        $archivo=$request->file('curriculum')->store('ArchivosCurriculum','public');
                        $url = Storage::url($archivo);
                        $Postulacion->curriculum=$url;
                    }
                    $Postulacion->email=$request->email;
                    $Postulacion->telefono=$request->telefono;
                    $Postulacion->titulo=$request->titulo;
                    $Postulacion->pais=$request->pais;
                    $Postulacion->institucion=$request->institucion;
                    $Postulacion->areaEstudio=$request->areaEstudio;
                    $Postulacion->nivelEstudio=$request->nivelEstudio;
                    $Postulacion->estadoEstudio=$request->estadoEstudio;
                  
                    // $Postulacion->curriculum=$request->curriculum;
                    $Postulacion->estado='1';
                    $Postulacion->save();
                    // return redirect()->route('Externo.index')->with('datos','Registrados exitosamente...');
                    // return redirect()->route('Postulacion.createP')->with('datos','Registrados exitosamente...');
                    $Ofertas = Oferta::all()->where('estado', '=','1');
                    return  redirect()->route('indexT');
    }

    public function edit($id)
    {
        // if (Auth::user()->Postulacion=='Encargado contrato'){ //boton editar
            $Postulacion=Postulacion::findOrFail($id);
            $personas = Persona::all();
            $ofertas = Oferta::all();
            return view('Postulacion.edit',compact('Postulacion','personas','ofertas'));
        // }else{
        //     return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'idOferta' => 'required|exists:oferta,idOferta',
            'fecha' => 'required|date',
            'email' => 'required',
            'telefono' => 'required|numeric',
            'titulo' => 'required|string',
            'pais' => 'required|string',
            'institucion' => 'required|string',
            'areaEstudio' => 'required|string',
            'nivelEstudio' => 'required|string',
            'estadoEstudio' => 'required|string',
        ]);
        $Postulacion=Postulacion::findOrFail($id);
        $Postulacion->DNI=$request->DNI;
                    $Postulacion->idOferta=$request->idOferta;
                    $Postulacion->fecha=$request->fecha;
                    $Postulacion->curriculum=$request->curriculum;
                    $Postulacion->email=$request->email;
                    $Postulacion->telefono=$request->telefono;
                    $Postulacion->titulo=$request->titulo;
                    $Postulacion->pais=$request->pais;
                    $Postulacion->institucion=$request->institucion;
                    $Postulacion->areaEstudio=$request->areaEstudio;
                    $Postulacion->nivelEstudio=$request->nivelEstudio;
                    $Postulacion->estadoEstudio=$request->estadoEstudio;
        $Postulacion->save();
        
        return redirect()->route('Postulacion.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Postulacion=Postulacion::findOrFail($id);
            $Postulacion->estado='0';
            $Postulacion->save();
            return redirect()->route('Postulacion.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Postulacion=='Encargado contrato'){ //boton eliminar
            $Postulacion=Postulacion::findOrFail($id);
            return view('Postulacion.confirmar',compact('Postulacion'));
        // }else{
        //     return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Postulacion.index')->with('datos','acciona cancelada...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Postulacions=Postulacion::all();
    //     if(count($Postulacions)==0){
    //         return false;
    //     }else{
    //         foreach($Postulacions as $Postulacion){
    //             if($Postulacion->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
