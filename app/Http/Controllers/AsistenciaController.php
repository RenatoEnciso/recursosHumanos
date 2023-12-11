<?php

namespace App\Http\Controllers;




use App\Models\Asistencia;
use App\Models\Contrato;
use App\Models\ContratoHorario;
use App\Models\Trabajador;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AsistenciaController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        // $busqueda=$request->get('busqueda');
        // // return $busqueda;
        // $Asistencias =  Asistencia::join('contrato_horario', 'asistencia.idContratoHorario', '=', 'contrato_horario.idContratoHorario')
        // ->join('contrato', 'contrato_horario.idContrato', '=', 'contrato.idContrato')
        // ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        // ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        // ->where(function ($query) use ($busqueda) {
        //     $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
        //         ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
        //         ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
        //         ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        // })
        // ->where('asistencia.estado', '=', '1')
        // ->paginate($this::PAGINATION);
        
        // return view('Asistencia.index',compact('Asistencias','busqueda'));
        $fechaActual = now();
        $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
        $usuarios = User::all();
            return view('Asistencia.index',compact('usuarios','contratos'));
    }

    public function create()
    {
        
        // if (Auth::user()->Asistencia=='Encargado contrato'){   //boteon registrar
            // $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            // $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
            //     ->where('fecha_fin', '>=', $fechaActual)
            //     ->get();
            // $contratoHorarios = ContratoHorario::whereHas('contrato', function ($query) use ($fechaActual) {
            //         $query->where('estado', '=', '1') // Filtrar contratos en vigencia
            //             ->where('fecha_inicio', '<=', $fechaActual) // La fecha de inicio debe ser menor o igual a la fecha actual
            //             ->where(function ($q) use ($fechaActual) {
            //                 $q->whereNull('fecha_fin') // Si la fecha de fin es nula, el contrato no tiene fecha de expiración
            //                     ->orWhere('fecha_fin', '>=', $fechaActual); // Si la fecha de fin es mayor o igual a la fecha actual, el contrato está en vigencia
            //             });
            //     });
            // $fecha_actual=Carbon::now();
            // $fecha_actual->setLocale('es'); 
            // $fecha_actual->setTimezone('America/Lima');
            // $usuarios = User::all();
            // return $fecha_actual;
            // return view('Asistencia.index',compact('contratos','fecha_actual','contratoHorarios','usuarios'));
            $fechaActual = now();
            $usuarios = User::all();
            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            return view('Asistencia.index',compact('usuarios','contratos'));
        // } else{
        //     return redirect()->route('Asistencia.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'horaRegistroEntrada' => 'required|date_format:H:i',
            'horaRegistroSalida' => 'required|date_format:H:i',
            'fechaRegistro' => 'required|date',
            'idContrato' => 'required|exists:Contrato,idContrato',
            // Agrega otras reglas de validación según tus necesidades
        ]);
        // Obtener el Contrato asociado al idContrato
        $contrato = Contrato::find($request->idContrato);
        if($contrato->estado=!1){
            return "Esta persona ya no cuenta con contrato en la empresa";
            return redirect()->back()->with('datos', 'Esta persona ya no cuenta con contrato en la empresa');
        }
        // Obtener el día actual (lunes = 1, martes = 2, ..., domingo = 7)
        $diaActual = date('N', strtotime($data['fechaRegistro']));

        // Obtener el ContratoHorario asociado al día actual y el Contrato
        $contratoHorario = $contrato->contratoHorarios()->where('diaSemana', $diaActual)->first();

    // Verificar si se encontró un ContratoHorario válido
    if ($contratoHorario) {
         // Verificar si ya hay una asistencia registrada para el día actual
         $existingAsistencia = Asistencia::where([
            'idContrato' => $contrato->idContrato,
            'fechaRegistro' => $data['fechaRegistro'],
        ])->first();

        // Determinar si es la entrada o la salida
        $tipoRegistro = $existingAsistencia ? 'horaRegistroSalida' : 'horaRegistroEntrada';

        // Obtener la hora actual en formato H:i
        $horaActual = date('H:i');

        // Verificar si la hora actual está dentro del límite del ContratoHorario
        if ($tipoRegistro == 'horaRegistroEntrada' && ($horaActual < $contratoHorario->horaInicio || $horaActual > $contratoHorario->horaFin)) {
            return "La hora de entrada no está dentro del límite permitido por el ContratoHorario.";
            return redirect()->back()->with('datos', 'La hora de entrada no está dentro del límite permitido por el ContratoHorario.');
        }

        // Actualizar o insertar el registro de asistencia
        Asistencia::updateOrInsert(
            [
                'idContrato' => $contrato->idContrato,
                'fechaRegistro' => $data['fechaRegistro'],
                'estado' => 1,
            ],
            [$tipoRegistro => $horaActual]
        );
        return "Registrados exitosamente...";
        return redirect()->route('dashboard')->with('datos','Registrados exitosamente...');
    } else {
        return "No tiene registrado un horario el dia de hoy";
        return redirect()->back()->with('datos', 'No tiene registrado un horario el dia de hoy');
    }

        // Crear una nueva instancia de Cese


    // Manejar la carga del archivo si está presente
        


        
                    // return redirect()->route('Asistencia.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Asistencia=='Encargado contrato'){ //boton editar
            $Asistencia=Asistencia::findOrFail($id);
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->get();
            $contratoHorarios = ContratoHorario::whereHas('contrato', function ($query) use ($fechaActual) {
                    $query->where('estado', '=', '1') // Filtrar contratos en vigencia
                        ->where('fecha_inicio', '<=', $fechaActual) // La fecha de inicio debe ser menor o igual a la fecha actual
                        ->where(function ($q) use ($fechaActual) {
                            $q->whereNull('fecha_fin') // Si la fecha de fin es nula, el contrato no tiene fecha de expiración
                                ->orWhere('fecha_fin', '>=', $fechaActual); // Si la fecha de fin es mayor o igual a la fecha actual, el contrato está en vigencia
                        });
                });
            $contratos = Contrato::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Asistencia.edit',compact('Asistencia','contratos','fecha_actual','contratoHorarios'));
        // }else{
        //     return redirect()->route('Asistencia.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $Asistencia=Asistencia::findOrFail($id);
        $data = $request->validate([
            'horaRegistroEntrada' => 'required|date_format:H:i',
            'horaRegistroSalida' => 'required|date_format:H:i',
            'fechaRegistro' => 'required|date',
            'idContratoHorario' => 'required|exists:contrato_horario,idContratoHorario',
            // Agrega otras reglas de validación según tus necesidades
        ]);

        $cese = Cese::update($data);
        // $Asistencia->save();
        return redirect()->route('Asistencia.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Asistencia=Asistencia::findOrFail($id);
            $Asistencia->estado='0';
            $Asistencia->save();
            return redirect()->route('Asistencia.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Asistencia=='Encargado contrato'){ //boton eliminar
            $Asistencia=Asistencia::findOrFail($id);
            return view('Asistencia.confirmar',compact('Asistencia'));
        // }else{
        //     return redirect()->route('Asistencia.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Asistencia.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Asistencia=Asistencia::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Asistencia.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Asistencias=Asistencia::all();
    //     if(count($Asistencias)==0){
    //         return false;
    //     }else{
    //         foreach($Asistencias as $Asistencia){
    //             if($Asistencia->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
