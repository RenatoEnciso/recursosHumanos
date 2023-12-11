<?php

namespace App\Http\Controllers;




use App\Models\HoraExtra;
use App\Models\Contrato;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HoraExtraController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $HoraExtras = HoraExtra::join('contrato', 'horaextra.idContrato', '=', 'horaextra.idContrato')
        ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        ->where(function ($query) use ($busqueda) {
            $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        })
        ->where('horaextra.estado', '=', '1')
        ->paginate($this::PAGINATION);

        
        return view('HoraExtra.index',compact('HoraExtras','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->HoraExtra=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('HoraExtra.create',compact('contratos','fecha_actual'));
        // } else{
        //     return redirect()->route('HoraExtra.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        $request->validate([
            'idContrato' => 'required',
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'descripcion' => 'required',
      
        ]);
        $HoraExtra = HoraExtra::create($data);
        $HoraExtra->update(['estado' => 1]);
        
        return redirect()->route('HoraExtra.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->HoraExtra=='Encargado contrato'){ //boton editar
            $HoraExtra=HoraExtra::findOrFail($id);
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            $contratos = Contrato::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('HoraExtra.edit',compact('HoraExtra','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('HoraExtra.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idContrato' => 'required',
            'fecha' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'descripcion' => 'required',
 
        ]);
        HoraExtra::find($id)->update($request->all());

        return redirect()->route('HoraExtra.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $HoraExtra=HoraExtra::findOrFail($id);
            $HoraExtra->estado='0';
            $HoraExtra->save();
            return redirect()->route('HoraExtra.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->HoraExtra=='Encargado contrato'){ //boton eliminar
            $HoraExtra=HoraExtra::findOrFail($id);
            return view('HoraExtra.confirmar',compact('HoraExtra'));
        // }else{
        //     return redirect()->route('HoraExtra.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('HoraExtra.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $HoraExtra=HoraExtra::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('HoraExtra.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $HoraExtras=HoraExtra::all();
    //     if(count($HoraExtras)==0){
    //         return false;
    //     }else{
    //         foreach($HoraExtras as $HoraExtra){
    //             if($HoraExtra->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
