<?php

namespace App\Http\Controllers;




use App\Models\Oferta;
use App\Models\Cargo;
use Carbon\Carbon;
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
        // if (Auth::user()->Oferta=='Encargado contrato'){   //boteon registrar
            $cargos = Cargo::all();
            $fecha_actual=Carbon::now();
            return view('Oferta.create',compact('cargos','fecha_actual'));
        // } else{
        //     return redirect()->route('Oferta.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                    ]);
                    $Oferta=new Oferta();
                    $Oferta->descripcion=$request->descripcion;
                    $Oferta->fecha_inicio=$request->fecha_inicio;
                    $Oferta->fecha_fin=$request->fecha_fin;
                    $Oferta->idCargo=$request->idCargo;
                    $Oferta->monto=$request->monto;
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
        $Oferta->idCargo=$request->idCargo;
        $Oferta->monto=$request->monto;
        $Oferta->save();
        return redirect()->route('Oferta.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Oferta=Oferta::findOrFail($id);
            $Oferta->estado='0';
            $Oferta->save();
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
    //     $Ofertas=Oferta::all();
    //     if(count($Ofertas)==0){
    //         return false;
    //     }else{
    //         foreach($Ofertas as $Oferta){
    //             if($Oferta->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
