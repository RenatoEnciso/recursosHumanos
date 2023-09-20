<?php

namespace App\Http\Controllers;



// use App\Models\Postulacion;
use App\Models\Persona;
use App\Models\Oferta;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // ->where('estado','=',1)
        ->distinct()
        ->paginate($this::PAGINATION);
        return view('Postulacion.index',compact('Postulacions','busqueda'));
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
                    ]);
                    $Postulacion=new Postulacion();
                    $Postulacion->DNI=$request->DNI;
                    $Postulacion->idOferta=$request->idOferta;
                    $Postulacion->fecha=$request->fecha;
                    $Postulacion->curriculum=$request->curriculum;
                    $Postulacion->estado='1';
                    $Postulacion->save();
                    return redirect()->route('Postulacion.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->Postulacion=='Encargado contrato'){ //boton editar
            $Postulacion=Postulacion::findOrFail($id);
            return view('Postulacion.edit',compact('Postulacion'));
        }else{
            return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $Postulacion=Postulacion::findOrFail($id);
        $Postulacion->DNI=$request->DNI;
        $Postulacion->idPostulacion=$request->idPostulacion;
        $Postulacion->fecha=$request->fecha;
        $Postulacion->observacion=$request->observacion;
        $Postulacion->estado=$request->estado;
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
        if (Auth::user()->Postulacion=='Encargado contrato'){ //boton eliminar
            $Postulacion=Postulacion::findOrFail($id);
            return view('Postulacion.confirmar',compact('Postulacion'));
        }else{
            return redirect()->route('Postulacion.index')->with('datos','..::No tiene Acceso ..::');
        }
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
