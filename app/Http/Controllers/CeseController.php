<?php

namespace App\Http\Controllers;




use App\Models\Cese;
use App\Models\Contrato;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CeseController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Ceses = Cese::join('contrato', 'cese.idContrato', '=', 'contrato.idContrato')
        ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        ->where(function ($query) use ($busqueda) {
            $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        })
        ->where('cese.estado', '=', '1')
        ->paginate($this::PAGINATION);
        
        return view('Cese.index',compact('Ceses','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Cese=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Cese.create',compact('contratos','fecha_actual'));
        // } else{
        //     return redirect()->route('Cese.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'fechaRegistro' => 'required',
            'idContrato' => 'required|exists:Contrato,idContrato',
            'observacion' => 'required|max:255',
            'archivoCese' => 'required', // Ajusta los formatos y tamaños según tus necesidades
        ]);
//corregir el archivo
        // Puedes manejar el archivoCese si es necesario, por ejemplo, almacenarlo en el sistema de archivos

        $cese = Cese::create($data);
        $cese->update(['estado' => 1]);

                    return redirect()->route('Cese.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Cese=='Encargado contrato'){ //boton editar
            $Cese=Cese::findOrFail($id);
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            // $contratos = Contrato::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Cese.edit',compact('Cese','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('Cese.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $cese=Cese::findOrFail($id);
        $data = $request->validate([
            'fechaRegistro' => 'required',
            'idContrato' => 'required|exists:Contrato,idContrato',
            'observacion' => 'required|max:255',
            'archivoCese' => 'required', // Ajusta los formatos y tamaños según tus necesidades
        ]);

        // Puedes manejar el archivoCese si es necesario, por ejemplo, almacenarlo en el sistema de archivos

        $cese->update($data);
        if ($request->hasFile('archivoCese')) {
            $archivo = $request->file('archivoCese')->store('ArchivosCese', 'public');
            $url = Storage::url($archivo);

            // Actualizar el campo 'archivoCese' en el modelo Cese
            $cese->update(['archivoCese' => $url]);
        }
        return redirect()->route('Cese.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Cese=Cese::findOrFail($id);
            $Cese->estado='0';
            $Cese->save();
            return redirect()->route('Cese.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Cese=='Encargado contrato'){ //boton eliminar
            $Cese=Cese::findOrFail($id);
            return view('Cese.confirmar',compact('Cese'));
        // }else{
        //     return redirect()->route('Cese.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Cese.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Cese=Cese::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Cese.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Ceses=Cese::all();
    //     if(count($Ceses)==0){
    //         return false;
    //     }else{
    //         foreach($Ceses as $Cese){
    //             if($Cese->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
