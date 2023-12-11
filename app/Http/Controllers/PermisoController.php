<?php

namespace App\Http\Controllers;




use App\Models\Permiso;
use App\Models\Contrato;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermisoController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Permisos =  Permiso::join('contrato', 'Permiso.idContrato', '=', 'contrato.idContrato')
        ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        ->where(function ($query) use ($busqueda) {
            $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        })
        ->where('Permiso.estado', '=', '1')
        ->paginate($this::PAGINATION);
        
        return view('Permiso.index',compact('Permisos','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Permiso=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Permiso.create',compact('contratos','fecha_actual'));
        // } else{
        //     return redirect()->route('Permiso.index')->with('datos','..::No tiene Acceso ..::');
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
                        if ($diferenciaDias < 30 || $diferenciaDias>$contrato->diasPermisos) {
                            $fail("La fecha de fin debe ser al menos 30 días después de la fecha de inicio y como máximo {$contrato->diasPermisos} días después. ");
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
            $permiso->update(['estado' => 1]);
                    return redirect()->route('Permiso.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Permiso=='Encargado contrato'){ //boton editar
            $Permiso=Permiso::findOrFail($id);
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
            return view('Permiso.edit',compact('Permiso','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('Permiso.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $Permiso=Permiso::findOrFail($id);
        $Permiso->fecha_inicio;
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
            function ($attribute, $value, $fail) use ($Permiso, $request) {
                $fechaInicio = Carbon::parse($value);
                $fechaActual = Carbon::now();
        
                // Si estamos editando y la fecha de inicio es la misma que ya está registrada, permitirlo.
                if ($request->filled('idTrabajador') && $fechaInicio->eq(Carbon::parse($Permiso->fecha_inicio))) {
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
        
        $Permiso->descripcion=$request->descripcion;
        $Permiso->fecha_inicio=$request->fecha_inicio;
        $Permiso->fecha_fin=$request->fecha_fin;
        $Permiso->idContrato=$request->idContrato;
        $Permiso->descripcion=$request->descripcion;
        $Permiso->save();
        return redirect()->route('Permiso.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Permiso=Permiso::findOrFail($id);
            $Permiso->estado='0';
            $Permiso->save();
            return redirect()->route('Permiso.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Permiso=='Encargado contrato'){ //boton eliminar
            $Permiso=Permiso::findOrFail($id);
            return view('Permiso.confirmar',compact('Permiso'));
        // }else{
        //     return redirect()->route('Permiso.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Permiso.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Permiso=Permiso::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Permiso.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Permisos=Permiso::all();
    //     if(count($Permisos)==0){
    //         return false;
    //     }else{
    //         foreach($Permisos as $Permiso){
    //             if($Permiso->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
