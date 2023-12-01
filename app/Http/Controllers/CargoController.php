<?php

namespace App\Http\Controllers;




use App\Models\Cargo;

use App\Models\Postulacion;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CargoController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        $Cargos=Cargo::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Cargo.index',compact('Cargos','busqueda'));
    }

    public function create()
    {
        // if (Auth::user()->Cargo=='Encargado de RRHH'){   //boteon registrar

            return view('Cargo.create');
        // } else{
        //     return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                'descripcion' => 'required|max:80',
                    ]);
                    $Cargo=new Cargo();
                    $Cargo->descripcion=$request->descripcion;
                    $Cargo->estado='1';
                    $Cargo->save();
                    return redirect()->route('Cargo.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Cargo=='Encargado de RRHH'){ //boton editar
            $Cargo=Cargo::findOrFail($id);
            return view('Cargo.edit',compact('Cargo'));
        // }else{
        //     return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'descripcion' => 'required|max:80',
        ]);
        $Cargo=Cargo::findOrFail($id);
        $Cargo->descripcion=$request->descripcion;
        $Cargo->save();
        return redirect()->route('Cargo.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Cargo=Cargo::findOrFail($id);
            $Cargo->estado='0';
            $Cargo->save();
            return redirect()->route('Cargo.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Cargo=='Administrador de Sistemas'){ //boton eliminar
            $Cargo=Cargo::findOrFail($id);
            return view('Cargo.confirmar',compact('Cargo'));
        // }else{
        //     return redirect()->route('Cargo.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Cargo.index')->with('datos','acciona cancelada...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Cargos=Cargo::all();
    //     if(count($Cargos)==0){
    //         return false;
    //     }else{
    //         foreach($Cargos as $Cargo){
    //             if($Cargo->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
