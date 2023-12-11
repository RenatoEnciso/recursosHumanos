<?php

namespace App\Http\Controllers;




use App\Models\Entrevista;
use App\Models\Persona;
use App\Models\Postulacion;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EntrevistaController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('buscarpor');
        $Entrevistas=Entrevista::select('idEntrevista','Entrevista.idPostulacion','Entrevista.fecha','p.DNI','observacion','Entrevista.estado','Entrevista.estadoEntrevista')
        ->join('Postulacion as p','p.idPostulacion','=','Entrevista.idPostulacion')
        // ->join('Persona as pe','p.DNI','=','pe.DNI')
        
        ->where('p.DNI','like','%'.$busqueda.'%')
        ->where('Entrevista.estado','=',1)
        ->distinct()
        ->paginate($this::PAGINATION);
        return view('Entrevista.index',compact('Entrevistas','busqueda'));
    }

    public function create()
    {
        // if (Auth::user()->Entrevista=='Encargado contrato'){   //boteon registrar
            $postulacion = Postulacion::all();
            $ofertas = Oferta::all();

            return view('Entrevista.create',compact('postulacion'));
        // } else{
        //     return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function createP($id)
    {
        // if (Auth::user()->Entrevista=='Encargado contrato'){   //boteon registrar
            $postulaciones = Postulacion::all();
            $postulacion = Postulacion::findOrFail($id);
            $oferta = Oferta::all();
            $entrevista = Entrevista::where('idPostulacion', $postulacion->idPostulacion)->first();
            if($entrevista){
                // return route('Entrevista.index')->with('datos','Ya esta contratado!!');
                return redirect()->back()->with('datos','Ya esta entrevistado!!');
            }else{
                return view('Entrevista.createP',compact('postulaciones','oferta','postulacion'));
            }

   
           
        // } else{
        //     return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
            $data=request()->validate([
                'idPostulacion' => 'required|exists:postulacion,idPostulacion',
                'fecha' => 'required|date',
                'observacion' => 'nullable|string|max:80',
                'estadoEntrevista' => 'required',
                    ]);
                    $Entrevista=new Entrevista();
                    $Entrevista->idPostulacion=$request->idPostulacion;
                    $Entrevista->fecha=$request->fecha;
                    $Entrevista->observacion=$request->observacion;
                    $Entrevista->estadoEntrevista=$request->estadoEntrevista;
                    $Entrevista->estado='1';
                    $Entrevista->save();
                    return redirect()->route('Entrevista.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Entrevista=='Encargado contrato'){ //boton editar
            $Entrevista=Entrevista::findOrFail($id);
            $postulacion = Postulacion::all();
            return view('Entrevista.edit',compact('Entrevista','postulacion'));
        // }else{
        //     return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'fecha' => 'required|date',
            'observacion' => 'nullable|string|max:80',
            'estadoEntrevista' => 'required',
        ]);
        $Entrevista=Entrevista::findOrFail($id);
        $Entrevista->idPostulacion=$request->idPostulacion;
        $Entrevista->fecha=$request->fecha;
        $Entrevista->observacion=$request->observacion;
        $Entrevista->estadoEntrevista=$request->estadoEntrevista;
        // $Entrevista->estado=$request->estado;
        $Entrevista->save();
        return redirect()->route('Entrevista.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Entrevista=Entrevista::findOrFail($id);
            $Entrevista->estado='0';
            $Entrevista->save();
            return redirect()->route('Entrevista.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Entrevista=='Encargado contrato'){ //boton eliminar
            $Entrevista=Entrevista::findOrFail($id);
            return view('Entrevista.confirmar',compact('Entrevista'));
        // }else{
        //     return redirect()->route('Entrevista.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Entrevista.index')->with('datos','acciona cancelada...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Entrevistas=Entrevista::all();
    //     if(count($Entrevistas)==0){
    //         return false;
    //     }else{
    //         foreach($Entrevistas as $Entrevista){
    //             if($Entrevista->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
