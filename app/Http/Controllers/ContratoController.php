<?php

namespace App\Http\Controllers;




use App\Models\Contrato;
use App\Models\ContratoHorario;
use App\Models\Trabajador;
use App\Models\Persona;
use App\Models\Entrevista;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DateTime;

class ContratoController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
     
  
        $Contratos = Contrato::select('*')
    ->join('trabajador as t', 't.idTrabajador', '=', 'Contrato.idTrabajador')
    ->join('Persona', 'Persona.DNI', '=', 't.DNI')
    ->where('Contrato.estado', '=', '1')
    ->where(function ($query) use ($busqueda) {
        $query->where('Persona.DNI', 'like', '%' . $busqueda . '%')
            ->orWhere('Persona.Nombres', 'like', '%' . $busqueda . '%')
            ->orWhere('Persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
            ->orWhere('Persona.Apellido_Materno', 'like', '%' . $busqueda . '%');
    })
    ->paginate($this::PAGINATION);
      
        
        return view('Contrato.index',compact('Contratos','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Contrato=='Encargado contrato'){   //boteon registrar
            
            $trabajadores = Trabajador::all();
            $entrevistas = Entrevista::all();
            $horarios = Horario::all();
            $personas = Persona::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            // return $fecha_actual;
            return view('Contrato.create',compact('personas','trabajadores','entrevistas','horarios','fecha_actual'));
        // } else{
        //     return redirect()->route('Contrato.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }
    public function createP($id)
    {
        $personas = Persona::all();
        // if (Auth::user()->Contrato=='Encargado contrato'){   //boteon registrar
            $trabajadores = Trabajador::all();
            $entrevista = Entrevista::findOrFail($id);
            $trabajador = Trabajador::where('DNI', $entrevista->DNI)->first();
                    // if ($trabajador) {
                    //     $Contrato->idTrabajador=$trabajador->idTrabajador;
                    // }
            
            $horarios = Horario::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');

            $contrato = Contrato::where('idEntrevista', $entrevista->idEntrevista)->first();
            if($contrato){
                // return route('Entrevista.index')->with('datos','Ya esta contratado!!');
                return redirect()->route('Entrevista.index')->with('datos','Ya esta contratado!!');
            }else{
                return view('Contrato.create',compact('personas','trabajadores','entrevista','horarios','fecha_actual'));
            }
            // return $fecha_actual;
            
        // } else{
        //     return redirect()->route('Contrato.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
    //    return $request->all();
            $data=request()->validate([
                'idHorario' => 'required',
              
                'monto' => 'required|numeric',
                'descripcion' => 'required|max:30',
                'fecha_inicio' => 'required|date',
        'fecha_fin' => [
            'required',
            'date',
            'after_or_equal:fecha_inicio',
            function ($attribute, $value, $fail) use ($request) {
                $fechaInicio = Carbon::parse($request->fecha_inicio);
                $fechaFin = Carbon::parse($value);
                $diferenciaDias = $fechaInicio->diffInDays($fechaFin);

                if ($diferenciaDias < 30) {
                    $fail("La fecha de fin debe ser al menos 30 días después de la fecha de inicio ");
                }
            },
        ],
        'diasVacaciones' => [
            'required',
            'numeric',
            'min:30',  // Asegura que el valor sea al menos 30
        ],

                'idEntrevista' => 'required',
                'ONP' => [
                    'required_if:idTrabajador,0', // ONP es requerido si idTrabajador es 0 (no existe)
                ],
                'correoPersonal' => [
                    'required_if:idTrabajador,0', // correoPersonal es requerido si idTrabajador es 0 (no existe)
             
                ],
                'telefono' => [
                    
                    'required_if:idTrabajador,0', // telefono es requerido si idTrabajador es 0 (no existe)
                
                ],
                'direccion' => [
                    'required_if:idTrabajador,0', // direccion es requerido si idTrabajador es 0 (no existe)
                ],
                // 'eventos.*.hora_fin' => [
                //     'required',
                //     'date_format:H:i|after:eventos.*.hora_inicio',
                //     function ($attribute, $value, $fail) use ($request) {
                //         $horaInicio = Carbon::parse($request->input('eventos.*.hora_inicio'));
                //         $horaFin = Carbon::parse($value);
            
                //         // Calcula la diferencia entre las dos horas
                //         $diferencia = $horaInicio->diff($horaFin);
            
                //         // Obtiene la diferencia en minutos
                //         $diferenciaEnMinutos = $diferencia->h * 60 + $diferencia->i;
            
                //         // Validación: La diferencia debe ser al menos de 60 minutos (1 hora) y no más de 480 minutos (8 horas)
                //         if ($diferenciaEnMinutos < 60 || $diferenciaEnMinutos > 480) {
                //             // Muestra un mensaje de error o realiza alguna acción
                //             $fail("La diferencia entre la hora de inicio y la hora de fin debe ser de 1 a 8 horas.");
                //         }
                //     },
                // ],
                // 'eventos.*.hora_inicio' => 'required_if:idHorario.*,0|date_format:H:i',
                // 'eventos.*.hora_fin' => 'required_if:idHorario.*,0|date_format:H:i|after:eventos.*.hora_inicio',
                // 'eventos.*.hora_inicio' => 'required_if:'.$request->idHorario[0].',0|date_format:H:i',
                // 'eventos.*.hora_fin' => 'required_if:'.$request->idHorario[0].',0|date_format:H:i|after:eventos.*.hora_inicio',
                // 'eventos.*.hora_inicio' => 'required_if:data.idHorario.*,0|date_format:H:i',
                // 'eventos.*.hora_fin' => 'required_if:data.idHorario.*,0|date_format:H:i|after:data.eventos.*.hora_inicio',
                'eventos.*.hora_inicio' => [
           
                    'date_format:H:i',
                    function ($attribute, $value, $fail) {
                        $index = explode('.', $attribute)[1];
                        $horaFin = request()->input("eventos.{$index}.hora_fin");
            
                        $horaInicio = \Carbon\Carbon::createFromFormat('H:i', $value);
                        $horaFin = \Carbon\Carbon::createFromFormat('H:i', $horaFin);
                        $diferenciaHoras = $horaInicio->diffInHours($horaFin);
                        if ($horaInicio >= $horaFin || $diferenciaHoras >8) {
                            $fail("La hora de inicio debe ser menor que la hora de fin para el evento {$index}.");
                        }
                    },
                    function ($attribute, $value, $fail) {
                        $index = explode('.', $attribute)[1];
            
                        // Verificar si la condición para hacer el campo requerido se cumple
                        $idHorario = request()->input("idHorario");
            
                        if (!empty($idHorario) && isset($idHorario[0]) && $idHorario[0] == "0" && empty($value)) {
                            $fail("La hora de inicio es requerida para el evento {$index} cuando idHorario[0] es 0. idhorario {$idHorario[0]} ");
                        }
                    },
                    'nullable', // Permitir valores nulos ya que la validación personalizada manejará la lógica de requerido
                    'date_format:H:i',
            
                ],
            
                'eventos.*.hora_fin' => ['date_format:H:i',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
        
                    // Verificar si la condición para hacer el campo requerido se cumple
                    $idHorario = request()->input("idHorario");
        
                    if (!empty($idHorario) && isset($idHorario[0]) && $idHorario[0] == "0" && empty($value)) {
                        $fail("La hora de inicio es requerida para el evento {$index} cuando idHorario[0] es 0. idhorario {$idHorario[0]} ");
                    }
                },
                'nullable', // Permitir valores nulos ya que la validación personalizada manejará la lógica de requerido
                'date_format:H:i',
            
            ],
                    ]);
                    $Entrevista=Entrevista::findOrFail($request->idEntrevista);
                    $trabajador = Trabajador::where('DNI', $Entrevista->Postulacion->DNI)->first();

                    
                    $Contrato=new Contrato();
                    $Contrato->descripcion=$request->descripcion;
                    $Contrato->fecha_inicio=$request->fecha_inicio;
                    $Contrato->fecha_fin=$request->fecha_fin;
                    $Contrato->diasVacaciones=$request->diasVacaciones;
                    $Contrato->idEntrevista=$request->idEntrevista;

         

                    // if($request->idTrabajador==0){
                        
                    // }
                    // return $trabajador;
                    // if ($trabajador) {
                    //     // Verificar si el trabajador ya está contratado en el periodo actual
                    //     $contratoExistente = Contrato::where('idTrabajador', $trabajador->idTrabajador)
                    //         ->where(function ($query) use ($request) {
                    //             $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
                    //                 ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin]);
                    //         })
                    //         ->first();
                    
                    //     if ($contratoExistente) {
                    //         // El trabajador ya está contratado en el periodo actual
                    //         return redirect()->back()->with('error', 'El trabajador ya está contratado en el periodo actual.');
                    //     }
                    // }
                    // else

                    if ($trabajador) {
                        // return "existe";
                        $contratoExistente = Contrato::where('idTrabajador', $trabajador->idTrabajador)
                            ->where(function ($query) use ($request) {
                                $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
                                    ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin]);
                            })
                            ->where('fecha_fin', '>', now()) // Verificar que la fecha de fin sea mayor a la fecha actual
                            ->first();
                    
                        if ($contratoExistente) {
                            // El trabajador ya está contratado en el periodo actual
                            return redirect()->back()->with('error', 'El trabajador ya está contratado en el periodo actual.');
                        }
                        $Contrato->idTrabajador=$trabajador->idTrabajador;
                    } else {
                        // return "no existe";
                        $Trabajador=new Trabajador();
                        $Trabajador->seguro=$request->seguro;
                        $Trabajador->ONP=$request->ONP;
                        $Trabajador->DNI=$request->DNI;
                        $Trabajador->correoPersonal=$request->correoPersonal;
                        $Trabajador->telefono=$request->telefono;
                        $Trabajador->direccion=$request->direccion;
                        $Trabajador->estado='1';
                        $Trabajador->save();
                        $trabajadores = Trabajador::all();
                        $Contrato->idTrabajador=$trabajadores->count();
                        
                    }

                    if($request->hasFile('contrato')){
                        $archivo=$request->file('contrato')->store('ArchivosContratos','public');
                        $url = Storage::url($archivo);
                        $Contrato->archivoContrato=$url;
                    }
                    $Contrato->diasVacaciones=$request->diasVacaciones;
              
                    $Contrato->monto=$request->monto;
                    $Contrato->estado='1';
                    $Contrato->save();

                    // $contratos = Contrato::all();
                    $ultimoIdContrato = Contrato::latest('idContrato')->first()->idContrato;

                    // ASIGNAR HORARIOS
                    // return $request->idHorario[0];
                    // return $request->idHorario[1];
                    if (!empty($request->idHorario) && isset($request->idHorario[0]) && $request->idHorario[0] == 0) {
                    // if($request->idHorario[0]==0){
                       
                        for ($i=0; $i <count($request->eventos) ; $i++) {
                            
                            for ($j=0; $j <count(($request->eventos[$i])['dias']) ; $j++) {
                                
                                $Horario=new Horario();

                                // $horaInicio = Carbon::createFromFormat('H:i', ($request->eventos[$i])['hora_inicio']);
                                // $horaFin = Carbon::createFromFormat('H:i', ($request->eventos[$i])['hora_fin']);

                                // // Calcula la diferencia entre las dos horas
                                // $diferencia = $horaInicio->diff($horaFin);

                                // // Obtiene la diferencia en minutos
                                // $diferenciaEnMinutos = $diferencia->h * 60 + $diferencia->i;

                                // // Validación: La diferencia debe ser al menos de 60 minutos (1 hora) y no más de 480 minutos (8 horas)
                                // if ($diferenciaEnMinutos < 60 || $diferenciaEnMinutos > 480) {
                                //     // Muestra un mensaje de error o realiza alguna acción
                                //     $fail("La diferencia entre la hora de inicio y la hora de fin debe ser de 1 a 8 horas.");
                                // }



                                
                                $Horario->hora_inicio=($request->eventos[$i])['hora_inicio'];
                                $Horario->hora_fin=($request->eventos[$i])['hora_fin'];
                                $Horario->dia=($request->eventos[$i])['dias'][$j];
                                $Horario->estado='1';
                                // return $Horario;
                                $Horario->save();
                                
                                $Horarios = Horario::all();
                                $ultimoIdHorario = Horario::latest('idHorario')->first()->idHorario;
                                
            
                                $Contrato_horario=new ContratoHorario();
                                $Contrato_horario->lugar=($request->eventos[$i])['lugar'];
                                // $Contrato_horario->idContrato=$contratos->count();
                                $Contrato_horario->idContrato=$ultimoIdContrato;
                                // $Contrato_horario->idHorario=$Horarios->count();
                                $Contrato_horario->idHorario=$ultimoIdHorario;
                                $Contrato_horario->estado='1';
                                $Contrato_horario->save();

                                // $mensaje=$mensaje.($request->eventos[$i])['dias'][$j].($request->eventos[$i])['hora'];
                                // $mensaje=($request->eventos[$i])['hora'];
                            } 
                        }

                      
                    }  
                    
                    // if($request->idHorario[1]!=0){
                        if (isset($request->idHorario) && is_array($request->idHorario) && count(array_filter($request->idHorario, function ($value) {
                            return $value != 0;
                        })) > 0) {
                            // return $request->idHorario;
                        for ($i=0; $i <count($request->idHorario) ; $i++) {
                            if($request->idHorario[$i]!=0){
                                $Contrato_horario=new ContratoHorario();
                                $Contrato_horario->lugar=$request->lugar;
                                // $Contrato_horario->idContrato=$contratos->count();
                                $Contrato_horario->lugar="RENIEC";
                                $Contrato_horario->idContrato=$ultimoIdContrato;
                                $Contrato_horario->idHorario=$request->idHorario[$i];
                                $Contrato_horario->estado='1';
                                $Contrato_horario->save();
                            }
                           
                         }
                    }


                    // for ($i=0; $i <count($request->Eventos) ; $i++) {
                    //     if($request->idHorario[i]==0){
                    //         $Horario=new Horario();
                    //         $Horario->hora_inicio=$request->hora_inicio[i];
                    //         $Horario->hora_fin=$request->descripcion[i];
                    //         $Horario->dia=$request->dia[i];
                    //         $Horario->estado='1';
                    //         $Horario->save();
                    //         $Horarios = Horario::all();
        
                            
        
                    //         $Contrato_horario=new Contrato_horario();
                    //         $Contrato_horario->lugar=$request->lugar;
                    //         $Contrato_horario->idContrato=$contratos->count();
                    //         $Contrato_horario->idHorario=$Horarios->count();
                    //         $Contrato_horario->estado='1';
                    //         $Contrato_horario->save();
                    //     }else{
                    //         $Contrato_horario=new Contrato_horario();
                    //         $Contrato_horario->lugar=$request->lugar;
                    //         $Contrato_horario->idContrato=$contratos->count();
                    //         $Contrato_horario->idHorario=$request->idHorario[i];
                    //         $Contrato_horario->estado='1';
                    //         $Contrato_horario->save();
                    //     }
                    // }

                    
                   
                   



                    
                    
                    // mandar a horari
                    return redirect()->route('Contrato.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Contrato=='Encargado contrato'){ //boton editar
            $Contrato=Contrato::findOrFail($id);
            $trabajadores = Trabajador::all();
            $entrevistas = Entrevista::all();
          
            $horarios = Horario::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual=$fecha_actual->toDateString();
            // return $fecha_actual;
            return view('Contrato.edit',compact('Contrato','entrevistas','horarios','trabajadores','fecha_actual'));
        // }else{
        //     return redirect()->route('Contrato.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([ 'idHorario' => 'required',
        'descripcion' => 'required|max:30',
 
        'monto' => 'required|numeric',
        'fecha_inicio' => 'required|date',
'fecha_fin' => [
    'required',
    'date',
    'after_or_equal:fecha_inicio',
    function ($attribute, $value, $fail) use ($request) {
        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaFin = Carbon::parse($value);
        $diferenciaDias = $fechaInicio->diffInDays($fechaFin);

        if ($diferenciaDias < 30) {
            $fail("La fecha de fin debe ser al menos 30 días después de la fecha de inicio ");
        }
    },
],
'diasVacaciones' => [
    'required',
    'numeric',
    'min:30',  // Asegura que el valor sea al menos 30
],

        'idEntrevista' => 'required',
        'ONP' => [
            'required_if:idTrabajador,0', // ONP es requerido si idTrabajador es 0 (no existe)
        ],
        'correoPersonal' => [
            'required_if:idTrabajador,0', // correoPersonal es requerido si idTrabajador es 0 (no existe)
            'email',
        ],
        'telefono' => [
            'required_if:idTrabajador,0', // telefono es requerido si idTrabajador es 0 (no existe)
            'numeric',
        ],
        'direccion' => [
            'required_if:idTrabajador,0', // direccion es requerido si idTrabajador es 0 (no existe)
        ],
        // 'eventos.*.hora_fin' => [
        //     'required',
        //     'date_format:H:i|after:eventos.*.hora_inicio',
        //     function ($attribute, $value, $fail) use ($request) {
        //         $horaInicio = Carbon::parse($request->input('eventos.*.hora_inicio'));
        //         $horaFin = Carbon::parse($value);
    
        //         // Calcula la diferencia entre las dos horas
        //         $diferencia = $horaInicio->diff($horaFin);
    
        //         // Obtiene la diferencia en minutos
        //         $diferenciaEnMinutos = $diferencia->h * 60 + $diferencia->i;
    
        //         // Validación: La diferencia debe ser al menos de 60 minutos (1 hora) y no más de 480 minutos (8 horas)
        //         if ($diferenciaEnMinutos < 60 || $diferenciaEnMinutos > 480) {
        //             // Muestra un mensaje de error o realiza alguna acción
        //             $fail("La diferencia entre la hora de inicio y la hora de fin debe ser de 1 a 8 horas.");
        //         }
        //     },
        // ],
        'eventos.*.hora_inicio' => 'required|date_format:H:i',
        'eventos.*.hora_fin' => 'required|date_format:H:i|after:eventos.*.hora_inicio',
            ]);
           
        $Contrato=Contrato::findOrFail($id);
        $Contrato->descripcion=$request->descripcion;
        $Contrato->fecha_inicio=$request->fecha_inicio;
        $Contrato->fecha_fin=$request->fecha_fin;
        $Contrato->diasVacaciones=$request->diasVacaciones;
        $Contrato->idEntrevista=$request->idEntrevista;

        $Entrevista=Entrevista::findOrFail($request->idEntrevista);
        $trabajador = Trabajador::where('DNI', $Entrevista->Postulacion->DNI)->first();

        // if($request->idTrabajador==0){
            
        // }
        // return $trabajador;
        if ($trabajador) {
            // return "existe";
            $Contrato->idTrabajador=$trabajador->idTrabajador;
        } else {
            // return "no existe";
            $Trabajador=new Trabajador();
            $Trabajador->seguro=$request->seguro;
            $Trabajador->ONP=$request->ONP;
            $Trabajador->DNI=$request->DNI;
            $Trabajador->correoPersonal=$request->correoPersonal;
            $Trabajador->telefono=$request->telefono;
            $Trabajador->direccion=$request->direccion;
            $Trabajador->estado='1';
            $Trabajador->save();
            $trabajadores = Trabajador::all();
            $Contrato->idTrabajador=$trabajadores->count();
            
        }

        if($request->hasFile('contrato')){
            $archivo=$request->file('contrato')->store('ArchivosContratos','public');
            $url = Storage::url($archivo);
            $Contrato->archivoContrato=$url;
        }
        $Contrato->diasVacaciones=$request->diasVacaciones;

        $Contrato->monto=$request->monto;
        $Contrato->estado='1';
        $Contrato->save();

        // $contratos = Contrato::all();
        $ultimoIdContrato = Contrato::latest('idContrato')->first()->idContrato;

        // ASIGNAR HORARIOS
        // return $request->idHorario[0];
        // return $request->idHorario[1];
        if (!empty($request->idHorario) && isset($request->idHorario[0]) && $request->idHorario[0] == 0) {
        // if($request->idHorario[0]==0){
           
            for ($i=0; $i <count($request->eventos) ; $i++) {
                
                for ($j=0; $j <count(($request->eventos[$i])['dias']) ; $j++) {
                    
                    $Horario=new Horario();

                    // $horaInicio = Carbon::createFromFormat('H:i', ($request->eventos[$i])['hora_inicio']);
                    // $horaFin = Carbon::createFromFormat('H:i', ($request->eventos[$i])['hora_fin']);

                    // // Calcula la diferencia entre las dos horas
                    // $diferencia = $horaInicio->diff($horaFin);

                    // // Obtiene la diferencia en minutos
                    // $diferenciaEnMinutos = $diferencia->h * 60 + $diferencia->i;

                    // // Validación: La diferencia debe ser al menos de 60 minutos (1 hora) y no más de 480 minutos (8 horas)
                    // if ($diferenciaEnMinutos < 60 || $diferenciaEnMinutos > 480) {
                    //     // Muestra un mensaje de error o realiza alguna acción
                    //     $fail("La diferencia entre la hora de inicio y la hora de fin debe ser de 1 a 8 horas.");
                    // }



                    
                    $Horario->hora_inicio=($request->eventos[$i])['hora_inicio'];
                    $Horario->hora_fin=($request->eventos[$i])['hora_fin'];
                    $Horario->dia=($request->eventos[$i])['dias'][$j];
                    $Horario->estado='1';
                    // return $Horario;
                    $Horario->save();
                    
                    $Horarios = Horario::all();
                    $ultimoIdHorario = Horario::latest('idHorario')->first()->idHorario;
                    

                    $Contrato_horario=new ContratoHorario();
                    $Contrato_horario->lugar=($request->eventos[$i])['lugar'];
                    // $Contrato_horario->idContrato=$contratos->count();
                    $Contrato_horario->idContrato=$ultimoIdContrato;
                    // $Contrato_horario->idHorario=$Horarios->count();
                    $Contrato_horario->idHorario=$ultimoIdHorario;
                    $Contrato_horario->estado='1';
                    $Contrato_horario->save();

                    // $mensaje=$mensaje.($request->eventos[$i])['dias'][$j].($request->eventos[$i])['hora'];
                    // $mensaje=($request->eventos[$i])['hora'];
                } 
            }

          
        }  
        // if($request->idHorario[1]!=0){
            if (isset($request->idHorario) && is_array($request->idHorario) && count($request->idHorario) >= 2 && $request->idHorario[1] != 0) {
            // return "existe";
            for ($i=1; $i <count($request->idHorario) ; $i++) {

                $Contrato_horario=new ContratoHorario();
                $Contrato_horario->lugar=$request->lugar;
                // $Contrato_horario->idContrato=$contratos->count();
                $Contrato_horario->idContrato=$ultimoIdContrato;
                $Contrato_horario->idHorario=$request->idHorario[$i];
                $Contrato_horario->estado='1';
                $Contrato_horario->save();
             }
        }
                    

        return redirect()->route('Contrato.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Contrato=Contrato::findOrFail($id);
            $Contrato->estado='0';
            $Contrato->save();
            return redirect()->route('Contrato.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Contrato=='Encargado contrato'){ //boton eliminar
            $Contrato=Contrato::findOrFail($id);
            return view('Contrato.confirmar',compact('Contrato'));
        // }else{
        //     return redirect()->route('Contrato.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Contrato.index')->with('datos','acciona cancelada...');
    }

    // public function archivo($id){
    //     $Contrato=Contrato::findOrFail($id);
    //     $cargos = Cargo::all();
    //         $fecha_actual=Carbon::now();
    //         $fecha_actual->setLocale('es'); 
    //         $fecha_actual->setTimezone('America/Lima');
    //     return view('Contrato.archivo',compact('cargos','fecha_actual'));
    // }
    // public function DniRepetido($dni_comprobar){
    //     $Contratos=Contrato::all();
    //     if(count($Contratos)==0){
    //         return false;
    //     }else{
    //         foreach($Contratos as $Contrato){
    //             if($Contrato->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
