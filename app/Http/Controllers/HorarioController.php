<?php

namespace App\Http\Controllers;




use App\Models\Horario;
use Carbon\Carbon;
use App\Models\Postulacion;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HorarioController extends Controller
{
    const PAGINATION=7;

    public function index(Request $request)
{
    // Obtener el término de búsqueda desde la solicitud
    $busqueda = strtoupper($request->get('busqueda'));

    // Mapear el término de búsqueda a los nombres completos de los días
    $nombresDias = [
        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miércoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sábado',
        '7' => 'Domingo',
    ];

    // Realizar la búsqueda en la base de datos
    $Horarios = Horario::where(function ($query) use ($nombresDias, $busqueda) {
        foreach ($nombresDias as $numeroDia => $nombreDia) {
            if (strpos(strtoupper($nombreDia), $busqueda) !== false) {
                $query->orWhere('dia', $numeroDia);
            }
        }
    })
    ->where('estado', '=', '1')
    ->paginate($this::PAGINATION);

    return view('Horario.index', compact('Horarios', 'busqueda'));
}

    public function create()
    {
        // if (Auth::user()->Horario=='Encargado de RRHH'){   //boteon registrar

            return view('Horario.create');
        // } else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'hora_inicio' => 'required',
            'hora_fin' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $horaInicio = Carbon::parse($request->hora_inicio);
                    $horaFin = Carbon::parse($value);
                    $diferenciaHoras = $horaInicio->diffInHours($horaFin);
        
                    if ($horaFin->lessThanOrEqualTo($horaInicio) || $diferenciaHoras < 1 || $diferenciaHoras > 8) {
                        $fail("La hora de fin debe ser mayor que la hora de inicio y la diferencia debe estar entre 1 y 8 horas.");
                    }
                },
            ],
            'dia' => 'required', // Ajusta según tus necesidades
            // Agrega otras reglas de validación según tus necesidades
        ]);
                    $Horario=new Horario();
                    $Horario->hora_inicio=$request->hora_inicio;
                    $Horario->hora_fin=$request->hora_fin;
                    $Horario->dia=$request->dia;
                    $Horario->estado='1';
                    $Horario->save();
                    return redirect()->route('Horario.index')->with('datos','Registrados exitosamente...');
    }

    public function edit($id)
    {
        // if (Auth::user()->Horario=='Encargado de RRHH'){ //boton editar
            $Horario=Horario::findOrFail($id);
            return view('Horario.edit',compact('Horario'));
        // }else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $data = request()->validate([
            'hora_inicio' => 'required',
            'hora_fin' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $horaInicio = Carbon::parse($request->hora_inicio);
                    $horaFin = Carbon::parse($value);
                    $diferenciaHoras = $horaInicio->diffInHours($horaFin);
        
                    if ($horaFin->lessThanOrEqualTo($horaInicio) || $diferenciaHoras < 1 || $diferenciaHoras > 8) {
                        $fail("La hora de fin debe ser mayor que la hora de inicio y la diferencia debe estar entre 1 y 8 horas.");
                    }
                },
            ],
            'dia' => 'required', // Ajusta según tus necesidades
            // Agrega otras reglas de validación según tus necesidades
        ]);
        $Horario=Horario::findOrFail($id);
        $Horario->hora_inicio=$request->hora_inicio;
        $Horario->hora_fin=$request->hora_fin;
        $Horario->dia=$request->dia;
        $Horario->save();
        return redirect()->route('Horario.index')->with('datos','Registro Actualizado exitosamente...');
    }

    public function destroy($id)
    {
            $Horario=Horario::findOrFail($id);
            $Horario->estado='0';
            $Horario->save();
            return redirect()->route('Horario.index')->with('datos','Registro Eliminado..');
    }


    public function confirmar($id){
        // if (Auth::user()->Horario=='Administrador de Sistemas'){ //boton eliminar
            $Horario=Horario::findOrFail($id);
            return view('Horario.confirmar',compact('Horario'));
        // }else{
        //     return redirect()->route('Horario.index')->with('datos','..::No tiene Acceso ..::');
        // }
    }


    public function cancelar(){
        return redirect()->route('Horario.index')->with('datos','acciona canceladaa...');
    }
    // public function DniRepetido($dni_comprobar){
    //     $Horarios=Horario::all();
    //     if(count($Horarios)==0){
    //         return false;
    //     }else{
    //         foreach($Horarios as $Horario){
    //             if($Horario->$DNI==$dni_comprobar){
    //                 return true;
    //                 break;
    //             }
    //         }
    //         return false;
    //     }
    // }

}
