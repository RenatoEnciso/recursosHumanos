<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RolController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $roles=Rol::where('nombreRol','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);


        return view('Rol.index',compact('roles','busqueda'));
    }

    public function create()
    {
        if (Auth::user()->rol=='Administrador de Sistemas'){   //boteon registrar

            return view('Rol.create');
        } else{
            return redirect()->route('Rol.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                'nombreRol' => 'required',
                    ]);
                    $rol=new Persona();
                    $rol->nombreRol=$request->nombreRol;
                    $rol->estado='1';
                    $rol->save();
                    return redirect()->route('Rol.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->rol=='Administrador de Sistemas'){ //boton editar
            $rol=Rol::findOrFail($id);
            return view('rol.edit',compact('rol'));
        }else{
            return redirect()->route('Rol.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'nombreRol' => 'required',
        ]);
        $rol=Rol::findOrFail($id);
        $rol->nombreRol=$request->nombreRol;
        $rol->save();
        return redirect()->route('Rol.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $rol=Rol::findOrFail($id);
            $persona->estado='0';
            $persona->save();
            return redirect()->route('Rol.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        if (Auth::user()->rol=='Administrador de Sistemas'){ //boton eliminar
            $rol=Rol::findOrFail($id);
            return view('Rol.confirmar',compact('rol'));
        }else{
            return redirect()->route('Rol.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Rol.index')->with('datos','acciona cancelada...');
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
