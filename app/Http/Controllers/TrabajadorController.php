<?php

namespace App\Http\Controllers;




use App\Models\Trabajador;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrabajadorController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request)
{
    $busqueda = $request->get('busqueda');

    $Trabajadores = Trabajador::where('estado', '=', '1')
        ->where(function ($query) use ($busqueda) {
            $query->where('DNI', 'like', '%' . $busqueda . '%')
                ->orWhereHas('persona', function ($subquery) use ($busqueda) {
                    $subquery->where('Nombres', 'like', '%' . $busqueda . '%')
                        ->orWhere('Apellido_Paterno', 'like', '%' . $busqueda . '%')
                        ->orWhere('Apellido_Materno', 'like', '%' . $busqueda . '%');
                });
        })
        ->paginate($this::PAGINATION);

    return view('Trabajador.index', compact('Trabajadores', 'busqueda'));
}
    public function create()
    {
        
        // if (Auth::user()->Trabajador=='Encargado contrato'){   //boteon registrar
            $personas = Persona::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Trabajador.create',compact('personas','fecha_actual'));
        // } else{
        //     return redirect()->route('Trabajador.index')->with('datos','..::No tiene Acceso ..::');
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
                    $Trabajador=new Trabajador();
                    $Trabajador->seguro=$request->seguro;
                    $Trabajador->ONP=$request->ONP;
                    $Trabajador->DNI=$request->DNI;
                    $Trabajador->correoPersonal=$request->correoPersonal;
                    $Trabajador->telefono=$request->telefono;
                    $Trabajador->direccion=$request->direccion;
                    $Trabajador->estado='1';
                    $Trabajador->save();
                    return redirect()->route('Trabajador.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Trabajador=='Encargado contrato'){ //boton editar
            $Trabajador=Trabajador::findOrFail($id);
            $personas = Persona::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Trabajador.edit',compact('Trabajador','personas','fecha_actual'));
        // }else{
        //     return redirect()->route('Trabajador.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'seguro' => 'required',
            'ONP' => 'required',
            'DNI' => 'required|size:8', // Ajusta el tamaño según tus requisitos
            'correoPersonal' => 'required|email',
            'telefono' => 'required|numeric|digits:9', // Ajusta el número de dígitos según tus requisitos
            'direccion' => 'required|max:255', // Ajusta el máximo de caracteres según tus requisitos
        ]);
        $Trabajador=Trabajador::findOrFail($id);
        $Trabajador->seguro=$request->seguro;
        $Trabajador->ONP=$request->ONP;
        $Trabajador->DNI=$request->DNI;
        $Trabajador->correoPersonal=$request->correoPersonal;
        $Trabajador->telefono=$request->telefono;
        $Trabajador->direccion=$request->direccion;
        $Trabajador->save();
        return redirect()->route('Trabajador.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Trabajador=Trabajador::findOrFail($id);
            $Trabajador->estado='0';
            $Trabajador->save();
            return redirect()->route('Trabajador.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Trabajador=='Encargado contrato'){ //boton eliminar
            $Trabajador=Trabajador::findOrFail($id);
            return view('Trabajador.confirmar',compact('Trabajador'));
        // }else{
        //     return redirect()->route('Trabajador.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Trabajador.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Trabajador=Trabajador::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Trabajador.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Trabajadors=Trabajador::all();
    //     if(count($Trabajadors)==0){
    //         return false;
    //     }else{
    //         foreach($Trabajadors as $Trabajador){
    //             if($Trabajador->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
