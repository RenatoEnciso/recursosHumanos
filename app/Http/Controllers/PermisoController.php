<?php

namespace App\Http\Controllers;




use App\Models\Vacacion;
use App\Models\Contrato;
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
        $Vacaciones =  Vacacion::join('contrato', 'vacacion.idContrato', '=', 'contrato.idContrato')
        ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        ->where(function ($query) use ($busqueda) {
            $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        })
        ->where('vacacion.estado', '=', '1')
        ->paginate($this::PAGINATION);
        
        return view('Vacacion.index',compact('Vacaciones','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Vacacion=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->get();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Vacacion.create',compact('contratos','fecha_actual'));
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
                'descripcion' => 'required|max:30',
                'fecha_inicio' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'fecha_fin' => [
                    'required',
                    'date',
                    'after_or_equal:fecha_inicio',
                    function ($attribute, $value, $fail) use ($request) {
                        $fechaInicio = Carbon::parse($request->fecha_inicio);
                        $fechaFin = Carbon::parse($value);
                        $diferenciaDias = $fechaInicio->diffInDays($fechaFin);
                        $contrato=Contrato::findOrFail($request->idContrato);
                        if ($diferenciaDias < 30 || $diferenciaDias>$contrato->diasVacaciones) {
                            $fail("La fecha de fin debe ser al menos 30 días después de la fecha de inicio y como máximo {$contrato->diasVacaciones} días después. ");
                        }
                    },
                ],
                'idContrato' => 'required',
           
        ],
        [
          
            // 'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
            // 'fecha_inicio.required'=>'Ingrese una fecha de inicio',
            // // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
            // 'fecha_fin.required'=>'Ingrese una fecha de fin',
            // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
           // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
                     // Crear una nueva instancia de Cese
            $permiso = Permiso::create($data);

        // Manejar la carga del archivo si está presente
            if ($request->hasFile('archivoPermiso')) {
                $archivo = $request->file('archivoPermiso')->store('ArchivosPermiso', 'public');
                $url = Storage::url($archivo);
    
                // Actualizar el campo 'archivoPermiso' en el modelo Cese
                $permiso->update(['archivoPermiso' => $url]);
            }
                    return redirect()->route('Vacacion.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Vacacion=='Encargado contrato'){ //boton editar
            $Vacacion=Vacacion::findOrFail($id);
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->get();
            $contratos = Contrato::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Vacacion.edit',compact('Vacacion','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('Vacacion.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $Vacacion=Vacacion::findOrFail($id);
        $Vacacion->fecha_inicio;
        $data=request()->validate([
            // 'descripcion'=>'required|max:30',
            // // 'fecha_inicio'=>'required',
         
            // 'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
            // 'descripcion'=>'required|max:30',
            // // 'fecha_inicio'=>'required',
            // 'fecha_inicio' => 'required|after_or_equal:yesterday',
        //     'fecha_fin'=>'required|before_or_equal:'.Carbon::parse($request->fecha_inicio)->addMonth(1)->format('Y-m-d'),
        // //    'archivo_nacimiento'=>'required',
        'descripcion' => 'required|max:30',
        'fecha_inicio' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($Vacacion, $request) {
                $fechaInicio = Carbon::parse($value);
                $fechaActual = Carbon::now();
        
                // Si estamos editando y la fecha de inicio es la misma que ya está registrada, permitirlo.
                if ($request->filled('idTrabajador') && $fechaInicio->eq(Carbon::parse($Vacacion->fecha_inicio))) {
                    return;
                }
        
                // Si la fecha de inicio es igual o posterior a la fecha actual, permitirlo.
                else if ($fechaInicio->greaterThanOrEqualTo($fechaActual)) {
                    return;
                }
                else
        
                // Si ninguna de las condiciones anteriores se cumple, mostrar un mensaje de error.
                $fail("La fecha de inicio debe ser mayor o igual a la fecha actual.");
            },
        ],
        
                'fecha_fin' => [
                    'required',
                    'date',
                    'after_or_equal:fecha_inicio',
                    function ($attribute, $value, $fail) use ($request) {
                        $fechaInicio = Carbon::parse($request->fecha_inicio);
                        $fechaFin = Carbon::parse($value);
                        $diferenciaDias = $fechaInicio->diffInDays($fechaFin);
        
                        if ($diferenciaDias < 30 || $diferenciaDias > 60) {
                            $fail("La fecha de fin debe ser al menos 30 días después de la fecha de inicio y como máximo 60 días después.");
                        }
                    },
                ],
                'idContrato' => 'required',
               
           
        ],
        [
          
        //     'descripcion.max'=>'Máximo 30 carácteres para la descripcion',
        //     'fecha_inicio.required'=>'Ingrese una fecha de inicio',
        //     // 'fecha_inicio.after_or_equal'=>'No se permite fechas menores a la actual',
        //     'fecha_fin.required'=>'Ingrese una fecha de fin',
        //     // 'lugar_nacimiento.max'=>'Máximo 30 carácteres para el lugar de Nacimiento',
        //    // 'archivo_nacimiento.required'=>'Ingrese el archivo de la Acta de Nacimiento',
        ]);
        
        $Vacacion->descripcion=$request->descripcion;
        $Vacacion->fecha_inicio=$request->fecha_inicio;
        $Vacacion->fecha_fin=$request->fecha_fin;
        $Vacacion->idContrato=$request->idContrato;
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
