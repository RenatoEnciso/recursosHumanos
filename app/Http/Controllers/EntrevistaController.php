<?php

namespace App\Http\Controller;
use App\Models\Entrevista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EntrevistaController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $Entrevistas=Entrevista::select('idEntrevista','DNI','p.Nombres','idOferta','observacion','estado')
        ->join('Persona as p','Persona.DNI','=','DNI')
        ->join('Oferta as o','Oferta.idOferta','=','idOferta')
        ->where('estado','=',1)
        ->where('p.Nombres','like','%'.$buscarpor.'%')
        ->distinct()
        ->paginate($this::PAGINATION);
        return view('Entrevista.index',compact('Entrevistas','busqueda'));
    }

    public function create()
    {
        if (Auth::user()->Entrevista=='Encargado contrato'){   //boteon registrar

            return view('Entrevista.create');
        } else{
            return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $Entrevista=new Persona();
                    $Entrevista->DNI=$request->DNI;
                    $Entrevista->idOferta=$request->idOferta;
                    $Entrevista->fecha=$request->fecha;
                    $Entrevista->observacion=$request->observacion;
                    $Entrevista->estado='1';
                    $Entrevista->save();
                    return redirect()->route('Entrevista.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->Entrevista=='Encargado contrato'){ //boton editar
            $Entrevista=Entrevista::findOrFail($id);
            return view('Entrevista.edit',compact('Entrevista'));
        }else{
            return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $Entrevista=Entrevista::findOrFail($id);
        $Entrevista->DNI=$request->DNI;
        $Entrevista->idOferta=$request->idOferta;
        $Entrevista->fecha=$request->fecha;
        $Entrevista->observacion=$request->observacion;
        $Entrevista->estado=$request->estado;
        $Entrevista->save();
        return redirect()->route('Entrevista.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Entrevista=Entrevista::findOrFail($id);
            $persona->estado='0';
            $persona->save();
            return redirect()->route('Entrevista.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->Entrevista=='Encargado contrato'){ //boton eliminar
            $Entrevista=Entrevista::findOrFail($id);
            return view('Entrevista.confirmar',compact('Entrevista'));
        }else{
            return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Entrevista.index')->with('datos','acciona cancelada...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $personas=Persona::all();
    //     if(count($personas)==0){
    //         return false;
    //     }else{
    //         foreach($personas as $persona){
    //             if($persona->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
