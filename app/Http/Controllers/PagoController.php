<?php

namespace App\Http\Controllers;




use App\Models\Pago;
use App\Models\Contrato;
use App\Models\Trabajador;
use App\Models\HoraExtra;
use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\DateTime;

class PagoController extends Controller
{
    
    const PAGINATION=7;

    public function index(Request $request){
        $busqueda=$request->get('busqueda');
        // return $busqueda;
        $Pagos = Pago::join('contrato', 'Pago.idContrato', '=', 'Pago.idContrato')
        ->join('trabajador', 'contrato.idTrabajador', '=', 'trabajador.idTrabajador')
        ->join('persona', 'trabajador.DNI', '=', 'persona.DNI')
        ->where(function ($query) use ($busqueda) {
            $query->where('persona.Nombres', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Paterno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.Apellido_Materno', 'like', '%' . $busqueda . '%')
                ->orWhere('persona.DNI', 'like', '%' . $busqueda . '%');
        })
        ->where('Pago.estado', '=', '1')
        ->paginate($this::PAGINATION);

        
        return view('Pago.index',compact('Pagos','busqueda'));
    }

    public function create()
    {
        
        // if (Auth::user()->Pago=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->get();
            $pago=Pago::join('contrato', 'Pago.idContrato', '=', 'Pago.idContrato');
            
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
        
            // return $fecha_actual;
            return view('Pago.create',compact('contratos','fecha_actual'));
        // } else{
        //     return redirect()->route('Pago.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function createP($id)
    {
        
        // if (Auth::user()->Pago=='Encargado contrato'){   //boteon registrar
            $fechaActual = now(); // Puedes ajustar esto según tu lógica para obtener la fecha actual
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
            $fecha_actual->format('Y-m');

            $contratos = Contrato::where('fecha_inicio', '<=', $fechaActual)
                ->where('fecha_fin', '>=', $fechaActual)
                ->where('estado', '=', '1')
                ->where('idTrabajador', '=', $id)
                ->get();

            // $pago=Pago::join('contrato', 'Pago.idContrato', '=', 'Pago.idContrato')
            // ->where('contrato.fecha_fin', '>=', $fechaActual)
            //     ->where('contrato.estado', '=', '1')
            //     ->where('contrato.idTrabajador', '=', $id)
            //     ->get();
            // ;

//PAGO
$mesesPagadosPorContrato = [];

foreach ($contratos as $contrato) {
    $pagos = Pago::where('idContrato', '=', $contrato->idContrato)->get();
    $mesesPagados = [];

    foreach ($pagos as $pago) {
        $periodo = Carbon::parse($pago->periodo)->format('Y-m');
        $mesesPagados[] = $periodo;
    }

    $mesesPagadosPorContrato[$contrato->idContrato] = $mesesPagados;
}

// Inicializar un array asociativo para almacenar los meses que faltan por contrato
$mesesFaltantesPorContrato = [];

foreach ($contratos as $contrato) {
    $fechaInicio = Carbon::parse($contrato->fecha_inicio)->startOfMonth();
    $fechaFin = Carbon::parse($contrato->fecha_fin)->endOfMonth();
    $mesesPagados = $mesesPagadosPorContrato[$contrato->idContrato] ?? [];

    $mesesFaltantes = [];

    while ($fechaInicio->lte($fechaFin)) {
        $periodo = $fechaInicio->format('Y-m');
        if($fecha_actual>$periodo){
            if (!in_array($periodo, $mesesPagados) && !in_array($periodo, $mesesFaltantes)) {
            
                $mesesFaltantes[] = $periodo;
            }
        }

        $fechaInicio->addMonth(); // Añadir un mes
    }

    $mesesFaltantesPorContrato[$contrato->idContrato] = $mesesFaltantes;
}


// return $mesesFaltantesPorContrato;
//FIN

      

          
            // return $contratos;
            // return $fecha_actual;
            return view('Pago.create',compact('contratos','fecha_actual','mesesFaltantesPorContrato'));
        // } else{
        //     return redirect()->route('Pago.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function store(Request $request)
    {
        
        $data = $request->validate([
            'periodo' => 'required',
            'idContrato' => 'required',
            'fechaRegistro' => 'required',
      
        ]);
        $Contrato=Contrato::findOrFail($request->idContrato);
        $contratoHorario = $Contrato->ContratoHorario;
        $horasTrabajadas=0;
        foreach ($contratoHorario as $item){
            // $horaInicioTimestamp = strtotime($item->horario->hora_inicio);
            // $horaFinTimestamp = strtotime($item->horario->hora_fin);

            
            // $horasTrabajadas+=$item->horario->hora_fin-$item->horario->hora_inicio;
            // Supongamos que $item->horario->hora_fin y $item->horario->hora_inicio están en formato de 24 horas

$horaInicio = Carbon::createFromFormat('H:i:s', $item->horario->hora_inicio);
$horaFin = Carbon::createFromFormat('H:i:s', $item->horario->hora_fin);

// Calcula la diferencia en horas
$horasTrabajadas += $horaFin->diffInHours($horaInicio);
        }
       
        // return $contratoHorario;
        $periodo = $request->periodo;
        $date = Carbon::parse($periodo);
        
    

        $client = new Client();
        
        $response = $client->request('GET', 'https://holidayapi.com/v1/holidays', [
            'query' => [
                'pretty' => null,
                'key' => 'e4f2fb62-c141-4e77-ac48-2f1ee3180d80',
                'country' => 'PE',
                'year' => '2023', // Cambiado a 2023 según tu ejemplo
            ]
        ]);
        
        $body = $response->getBody();
        $content = json_decode($body->getContents());
        
        $holidays = $content->holidays;

        // return $holidays[0]->date;
        $monthToFilter = $date->month;
       

        $filteredHolidays = array_filter($holidays, function($holiday) use ($monthToFilter) {
            $holidayDate = Carbon::parse($holiday->date);
            return $holidayDate->month == $monthToFilter;
        });
        // return count($filteredHolidays);
        $diasFeriados=count($filteredHolidays);
        $diasEnMes = $date->daysInMonth - count($filteredHolidays) ;
        // corregir segun contrati cantidad de horas
        $horasMes =  $horasTrabajadas/7*$date->daysInMonth;
        $salarioxHora= $Contrato->monto / ($diasEnMes*$horasTrabajadas/7);
        // return $salarioxHora;

        $horasExtras = 0;
        $periodo = Carbon::parse($request->periodo);
        $year = $periodo->year;
        $month = $periodo->month;

        $HoraExtras = HoraExtra::where('idContrato', '=', $request->idContraro)
            ->whereYear('fecha', '=', $year)
            ->whereMonth('fecha', '=', $month)
            ->get();

        $Sobretiempo25=0;
        $Sobretiempo35=0;
        foreach ($HoraExtras as $item){
            $inicio = Carbon::createFromFormat('H:i:s', $item->hora_inicio);
            $fin = Carbon::createFromFormat('H:i:s', $item->hora_fin);
            $horasExtras += $fin->diffInHours($inicio);
            if ($horasExtras <= 2) {
                $Sobretiempo25 += $horasExtras * $salarioxHora * 1.25;
            } else {
                $Sobretiempo25 += 2 * $salarioxHora * 1.25;
                $Sobretiempo35 += ($horasExtras - 2) * $salarioxHora * 1.35;
            }

        }

// faltaponerjustificacionesx
        $Asistencias = Asistencia::join('Contrato', 'Contrato.idContrato', '=', 'Asistencia.idContrato')
            ->where('Contrato.idContrato', '=', $request->idContrato)
            ->whereYear('Asistencia.fechaRegistro', '=', $year)
            ->whereMonth('Asistencia.fechaRegistro', '=', $month)
            ->get();
            
            // $diasFaltados = $date->daysInMonth - count($Asistencias);
            $diasFaltados = $diasEnMes - count($Asistencias);
            $faltasDinero=$diasFaltados*$horasTrabajadas/7*$salarioxHora;
            $seguro=0;
            $salud=0;
            if($diasFaltados<5){
                $seguro=$Contrato->monto*0.13;
                $salud=$Contrato->monto*0.9;
            }
                
            $neto=$Contrato->monto - $faltasDinero + $Sobretiempo25+ $Sobretiempo35 -  $seguro-$salud;
            // return $diasFaltados;
        // return $horasExtras;
        // $Contrato=Contrato::findOrFail($request->idContrato);
        // $Contrato->monto;



        // $Contrato->HoraExtra->fecha;

        $Pago=new Pago();
        $Pago->periodo=Carbon::now();
        $Pago->idContrato=$request->idContrato;
        $Pago->fechaRegistro=$request->fechaRegistro;
        $Pago->ingresos=$Contrato->monto+ $Sobretiempo25+ $Sobretiempo35;
        $Pago->descuentos=$faltasDinero;
        $Pago->aportes=$seguro+$salud;
        $Pago->estado='1';
        // $Pago->save();

        // $Pago = Pago::create($data);
        // $Pago->update(['estado' => 1]);

   
        $pdf = Pdf::loadView('Pago.boleta',compact('Contrato','periodo','Asistencias','faltasDinero','seguro','salud','horasExtras','horasMes','Sobretiempo25','Sobretiempo35','diasFaltados','diasEnMes','diasFeriados','neto'));
        // return $pdf->stream('ActaDefuncion.pdf');
        return $pdf->stream('Pago.boleta.pdf');


        // return view('Pago.boleta',compact('Contrato','periodo','Asistencias','faltasDinero','seguro','salud','horasExtras','horasMes','Sobretiempo25','Sobretiempo35','diasFaltados','diasEnMes','diasFeriados','neto'));
        // return redirect()->route('Pago.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Pago=='Encargado contrato'){ //boton editar
            $Pago=Pago::findOrFail($id);
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
            return view('Pago.edit',compact('Pago','contratos','fecha_actual'));
        // }else{
        //     return redirect()->route('Pago.index')->with('datos','..::No tiene Acceso ..::');
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
        Pago::find($id)->update($request->all());

        return redirect()->route('Pago.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Pago=Pago::findOrFail($id);
            $Pago->estado='0';
            $Pago->save();
            return redirect()->route('Pago.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Pago=='Encargado contrato'){ //boton eliminar
            $Pago=Pago::findOrFail($id);
            return view('Pago.confirmar',compact('Pago'));
        // }else{
        //     return redirect()->route('Pago.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Pago.index')->with('datos','acciona cancelada...');
    }

    public function archivo($id){
        $Pago=Pago::findOrFail($id);
        $cargos = Cargo::all();
            $fecha_actual=Carbon::now();
            $fecha_actual->setLocale('es'); 
            $fecha_actual->setTimezone('America/Lima');
        return view('Pago.archivo',compact('cargos','fecha_actual'));
    }


    public function boletaGenerada($id){
        $actaPersona= Acta_Persona::findOrFail($id);
        $actaGenerada=Acta::findOrFail($actaPersona->idActa);
        $fecha = date('Y-m-d');
        $data = compact('actaGenerada','actaPersona','fecha');
        $pdf = Pdf::loadView('ActaDefunsion.actaGenerada', $data);
        //return $pdf->stream('ActaDefuncion.pdf');
        return $pdf->download('ActaDefuncion.pdf');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Pagos=Pago::all();
    //     if(count($Pagos)==0){
    //         return false;
    //     }else{
    //         foreach($Pagos as $Pago){
    //             if($Pago->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
