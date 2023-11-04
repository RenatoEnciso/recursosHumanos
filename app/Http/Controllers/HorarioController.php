<?php

namespace App\Http\Controllers;




use App\Models\Horario;

use App\Models\Postulacion;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HorarioController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $Horarios=Horario::where('dia','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        return view('Horario.index',compact('Horarios','busqueda'));
    }

    public function create()
    {
        // if (Auth::user()->Horario=='Encargado de RRHH'){   //boteon registrar

            return view('Horario.create');
        // } else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $Horario=new Horario();
                    $Horario->hora_inicio=$request->hora_inicio;
                    $Horario->hora_fin=$request->descripcion;
                    $Horario->dia=$request->dia;
                    $Horario->estado='1';
                    $Horario->save();
                    return redirect()->route('Horario.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Horario=='Encargado de RRHH'){ //boton editar
            $Horario=Horario::findOrFail($id);
            return view('Horario.edit',compact('Horario'));
        // }else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([

        ]);
        $Horario=Horario::findOrFail($id);
        $Horario->hora_inicio=$request->hora_inicio;
        $Horario->hora_fin=$request->descripcion;
        $Horario->dia=$request->dia;
        $Horario->save();
        return redirect()->route('Horario.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Horario=Horario::findOrFail($id);
            $Horario->estado='0';
            $Horario->save();
            return redirect()->route('Horario.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Horario=='Administrador de Sistemas'){ //boton eliminar
            $Horario=Horario::findOrFail($id);
            return view('Horario.confirmar',compact('Horario'));
        // }else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Horario.index')->with('datos','acciona canceladaa...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Horarios=Horario::all();
    //     if(count($Horarios)==0){
    //         return false;
    //     }else{
    //         foreach($Horarios as $Horario){
    //             if($Horario->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
