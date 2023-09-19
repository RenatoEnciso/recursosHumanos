<?php

namespace App\Http\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CargoController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $Cargos=Cargo::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Cargo.index',compact('Cargos','busqueda'));
    }

    public function create()
    {
        if (Auth::user()->Cargo=='Encargado de RRHH'){   //boteon registrar

            return view('Cargo.create');
        } else{
            return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $Cargo=new Persona();
                    $Cargo->descripcion=$request->descripcion;
                    $Cargo->estado='1';
                    $Cargo->save();
                    return redirect()->route('Cargo.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->Cargo=='Encargado de RRHH'){ //boton editar
            $Cargo=Cargo::findOrFail($id);
            return view('Cargo.edit',compact('Cargo'));
        }else{
            return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $Cargo=Cargo::findOrFail($id);
        $Cargo->descripcion=$request->descripcion;
        $Cargo->save();
        return redirect()->route('Cargo.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Cargo=Cargo::findOrFail($id);
            $persona->estado='0';
            $persona->save();
            return redirect()->route('Cargo.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->Cargo=='Administrador de Sistemas'){ //boton eliminar
            $Cargo=Cargo::findOrFail($id);
            return view('Cargo.confirmar',compact('Cargo'));
        }else{
            return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Cargo.index')->with('datos','acciona cancelada...');
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
