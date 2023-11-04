<?php

namespace App\Http\Controllers;




use App\Models\Contrato_horario;
use App\Models\Contrato;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContratoHorarioController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Contrato_horarios=Contrato_horario::where('lugar','like','%'.$busqueda.'%')
        ->where('estado','=','1')
        ->paginate($this::PAGINATION);
        
        return view('Contrato_horario.index',compact('Contrato_horarios','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Contrato_horario=='Encargado contrato'){   //boteon registrar
            $contratos = Contrato::all();
            $horarios = Horario::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Contrato_horario.create',compact('horarios','contratos','fecha_actual'));
        // } else{
        //     return redirect()->route('Contrato_horario.index')->with('datos','..::No tiene Acceso ..::');
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
                    $Contrato_horario=new Contrato_horario();
                    $Contrato_horario->lugar=$request->lugar;
                    $Contrato_horario->idContrato=$request->idContrato;
                    $Contrato_horario->idHorario=$request->idHorario;
                    $Contrato_horario->estado='1';
                    $Contrato_horario->save();
                    return redirect()->route('Contrato_horario.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Contrato_horario=='Encargado contrato'){ //boton editar
            $Contrato_horario=Contrato_horario::findOrFail($id);
            $contratos = Contrato::all();
            $horarios = Horarios::all();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Contrato_horario.edit',compact('Contrato_horario','horarios','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('Contrato_horario.index')->with('datos','..::No tiene Acceso ..::');
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
        $Contrato_horario=Contrato_horario::findOrFail($id);
        $Contrato_horario=new Contrato_horario();
        $Contrato_horario->lugar=$request->lugar;
        $Contrato_horario->idContrato=$request->idContrato;
        $Contrato_horario->idHorario=$request->idHorario;
        $Contrato_horario->save();
        return redirect()->route('Contrato_horario.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Contrato_horario=Contrato_horario::findOrFail($id);
            $Contrato_horario->estado='0';
            $Contrato_horario->save();
            return redirect()->route('Contrato_horario.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Contrato_horario=='Encargado contrato'){ //boton eliminar
            $Contrato_horario=Contrato_horario::findOrFail($id);
            return view('Contrato_horario.confirmar',compact('Contrato_horario'));
        // }else{
        //     return redirect()->route('Contrato_horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Contrato_horario.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Contrato_horario=Contrato_horario::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Contrato_horario.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Contrato_horarios=Contrato_horario::all();
    //     if(count($Contrato_horarios)==0){
    //         return false;
    //     }else{
    //         foreach($Contrato_horarios as $Contrato_horario){
    //             if($Contrato_horario->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
