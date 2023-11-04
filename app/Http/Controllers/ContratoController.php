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

class ContratoController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
     
  
        $Contratos=Contrato::select('*')
        ->join('trabajador as t','t.idTrabajador','=','Contrato.idTrabajador')
        ->join('Persona','Persona.DNI','=','t.DNI')
        ->where('Persona.DNI','like','%'.$busqueda.'%')
        ->where('Contrato.estado','=','1')
        ->paginate($this::PAGINATION);
        
        return view('Contrato.index',compact('Contratos','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Contrato=='Encargado contrato'){   //boteon registrar
            
            $trabajadores = Trabajador::all();
            $entrevistas = Entrevista::all();
            $horarios = Horario::all();
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
        // $mensaje="";
        // for ($i=0; $i <count($request->eventos) ; $i++) {
        //     for ($j=0; $j <count(($request->eventos[$i])['dias']) ; $j++) {
            
        //         $mensaje=$mensaje.($request->eventos[$i])['dias'][$j].($request->eventos[$i])['hora'];
        //         $mensaje=($request->eventos[$i])['hora'];
        //     } 
        //     $mensaje=($request->eventos[$i])['dias'];
        // }   
        // return $mensaje;
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
                    $Contrato=new Contrato();
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
                    $Contrato->estado='1';
                    $Contrato->save();

                    // $contratos = Contrato::all();
                    $ultimoIdContrato = Contrato::latest('idContrato')->first()->idContrato;

                    // ASIGNAR HORARIOS
                    // return $request->idHorario[0];
                    // return $request->idHorario[1];
                    if($request->idHorario[0]==0){
                       
                        for ($i=0; $i <count($request->eventos) ; $i++) {
                            
                            for ($j=0; $j <count(($request->eventos[$i])['dias']) ; $j++) {
                                $Horario=new Horario();
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
                    if($request->idHorario[1]!=0){
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
        $Contrato=new Contrato();
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
                    $Contrato->estado='1';
                    $Contrato->save();

                    // $contratos = Contrato::all();
                    $ultimoIdContrato = Contrato::latest('idContrato')->first()->idContrato;

                    // ASIGNAR HORARIOS
                    // return $request->idHorario[0];
                    // return $request->idHorario[1];
                    if($request->idHorario[0]==0){
                       
                        for ($i=0; $i <count($request->eventos) ; $i++) {
                            
                            for ($j=0; $j <count(($request->eventos[$i])['dias']) ; $j++) {
                                $Horario=new Horario();
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
                    if($request->idHorario[1]!=0){
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
