<?php

namespace App\Http\Controllers;




use App\Models\Vacacion;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VacacionController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Vacaciones=Vacacion::where('descripcion','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        
        return view('Vacacion.index',compact('Vacaciones','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Vacacion=='Encargado contrato'){   //boteon registrar
            $trabajadores = Trabajador::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Vacacion.create',compact('trabajadores','fecha_actual'));
        // } else{
        //     return redirect()->route('Vacacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        // return $request->all();
        // Carbon::
        // return $request->all
        // 'resultados'
        $data=request()->validate([
            // 'seguro'=>'required',
            // // 'fecha_inicio'=>'required',
            // 'fecha_inicio' => 'required',
            // 'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
            // 'requisitos'=>'required',
            // 'manualPostulante'=>'required',
        //    'archivo_nacimiento'=>'required',
           
        ],
        [
          
            // 'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
            // 'fecha_inicio.required'=>'Ingrese una fecha de inicio',
            // // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
            // 'fecha_fin.required'=>'Ingrese una fecha de fin',
            // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
           // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
            $data=request()->validate([
                    ]);
                    $Vacacion=new Vacacion();
                    $Vacacion->descripcion=$request->descripcion;
                    $Vacacion->fecha_inicio=$request->fecha_inicio;
                    $Vacacion->fecha_fin=$request->fecha_fin;
                    $Vacacion->idTrabajador=$request->idTrabajador;
                    $Vacacion->descripcion=$request->descripcion;
                    $Vacacion->estado='1';
                    $Vacacion->save();
                    return redirect()->route('Vacacion.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Vacacion=='Encargado contrato'){ //boton editar
            $Vacacion=Vacacion::findOrFail($id);
            $trabajadores = Trabajador::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Vacacion.edit',compact('Vacacion','trabajadores','fecha_actual'));
        // }else{
        //     return redirect()->route('Vacacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            // 'descripcion'=>'required|max:30',
            // // 'fecha_inicio'=>'required',
         
            // 'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
            // 'descripcion'=>'required|max:30',
            // // 'fecha_inicio'=>'required',
            // 'fecha_inicio' => 'required|after_or_equal:yesterday',
        //     'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
        // //    'archivo_nacimiento'=>'required',
           
        ],
        [
          
        //     'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
        //     'fecha_inicio.required'=>'Ingrese una fecha de inicio',
        //     // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
        //     'fecha_fin.required'=>'Ingrese una fecha de fin',
        //     // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
        //    // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
        $Vacacion=Vacacion::findOrFail($id);
        $Vacacion->descripcion=$request->descripcion;
        $Vacacion->fecha_inicio=$request->fecha_inicio;
        $Vacacion->fecha_fin=$request->fecha_fin;
        $Vacacion->idTrabajador=$request->idTrabajador;
        $Vacacion->descripcion=$request->descripcion;
        $Vacacion->save();
        return redirect()->route('Vacacion.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Vacacion=Vacacion::findOrFail($id);
            $Vacacion->estado='0';
            $Vacacion->save();
            return redirect()->route('Vacacion.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Vacacion=='Encargado contrato'){ //boton eliminar
            $Vacacion=Vacacion::findOrFail($id);
            return view('Vacacion.confirmar',compact('Vacacion'));
        // }else{
        //     return redirect()->route('Vacacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Vacacion.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Vacacion=Vacacion::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Vacacion.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Vacacions=Vacacion::all();
    //     if(count($Vacacions)==0){
    //         return false;
    //     }else{
    //         foreach($Vacacions as $Vacacion){
    //             if($Vacacion->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
