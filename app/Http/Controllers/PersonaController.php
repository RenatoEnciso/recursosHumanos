<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PersonaController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $personas=Persona::where('Apellido_Paterno','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);;


        return view('persona.index',compact('personas','busqueda'));
    }

    public function create()
    {
        if (Auth::user()->rol=='Administrativo'){   //boteon registrar

            return view('persona.create');
        } else{
            return redirect()->route('Persona.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $persona=new Persona();
                    $persona->dni=$request->dni;
                    $persona->apellido_paterno=$request->Apellido1;
                    $persona->apellido_materno=$request->Apellido2;
                    $persona->nombres=$request->nombres;
                    $persona->sexo=$request->sexo;
                    $persona->estado='1';
                    $persona->save();
                    return redirect()->route('Persona.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        if (Auth::user()->rol=='Administrativo'){ //boton editar
            $persona=Persona::findOrFail($id);
            return view('persona.edit',compact('persona'));
        }else{
            return redirect()->route('Persona.index')->with('datos','..::No tiene Acceso ..::');
        }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $persona=Persona::findOrFail($id);
        $persona->apellido_paterno=$request->Apellido1;
        $persona->apellido_materno=$request->Apellido2;
        $persona->nombres=$request->nombres;
        $persona->sexo=$request->sexo;
        $persona->save();
        return redirect()->route('Persona.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $persona=Persona::findOrFail($id);
            $persona->estado='0';
            $persona->save();
            return redirect()->route('Persona.index')->with('datos','Registro Eliminado..');


    }


    public function confirmar($id){
        if (Auth::user()->rol=='Administrativo'){ //boton eliminar
            $persona=Persona::findOrFail($id);
            return view('Persona.confirmar',compact('persona'));
        }else{
            return redirect()->route('Persona.index')->with('datos','..::No tiene Acceso ..::');
        }
    }


    public function cancelar(){
        return redirect()->route('Persona.index')->with('datos','acciona cancelada...');
    }

}
