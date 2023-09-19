<?php

namespace App\Http\Controller;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OfertaController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $Ofertas=Oferta::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Oferta.index',compact('Ofertas','busqueda'));
    }

    public function create()
    {
        if (Auth::user()->Oferta=='Encargado contrato'){   //boteon registrar

            return view('Oferta.create');
        } else{
            return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $Oferta=new Persona();
                    $Oferta->descripcion=$request->descripcion;
                    $Oferta->fecha_inicio=$request->fecha_inicio;
                    $Oferta->fecha_fin=$request->fecha_fin;
                    $Oferta->idOferta=$request->idOferta;
                    $Oferta->estado='1';
                    $Oferta->save();
                    return redirect()->route('Oferta.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->Oferta=='Encargado contrato'){ //boton editar
            $Oferta=Oferta::findOrFail($id);
            return view('Oferta.edit',compact('Oferta'));
        }else{
            return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $Oferta=Oferta::findOrFail($id);
        $Oferta->descripcion=$request->descripcion;
        $Oferta->fecha_inicio=$request->fecha_inicio;
        $Oferta->fecha_fin=$request->fecha_fin;
        $Oferta->idOferta=$request->idOferta;
        $Oferta->save();
        return redirect()->route('Oferta.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Oferta=Oferta::findOrFail($id);
            $persona->estado='0';
            $persona->save();
            return redirect()->route('Oferta.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->Oferta=='Encargado contrato'){ //boton eliminar
            $Oferta=Oferta::findOrFail($id);
            return view('Oferta.confirmar',compact('Oferta'));
        }else{
            return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Oferta.index')->with('datos','acciona cancelada...');
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
