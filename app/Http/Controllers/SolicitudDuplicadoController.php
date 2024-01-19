<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SolDniPrimeraVezCreateRequest;
use App\Models\Persona;
use App\Models\SolicitudDNI;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SolicitudDuplicadoController extends Controller
{
    const PAGINATION = 10;
    /* public function inicio(Request $request){
        return view('ciudadano.index');
    }*/

    public function formValidar()
    {
        return view('SolicitudDNI.solDuplicado.validation');
    }


    public function validar(Request $request)
    {
        $request->validate(
            [
                'dni' => 'required',
                'fechaNacimiento' => 'required|date',
                'departamento' => 'required',
                'provincia' => 'required',
                'distrito' => 'required'
            ],
            [
                'dni.required' => 'Ingrese el Numero de DNI',
                'fechaNacimiento.required' => 'Ingrese una Fecha de Nacimiento',
                'departamento.required' => 'Ingrese el departamento de  nacimiento',
                'provincia.required' => 'Ingrese la provincia de nacimiento',
                'distrito.required' => 'Ingrese el distrito de nacimiento',
            ]
        );

        $persona = Persona::findOrFail($request->dni);
        $list1_personas = Persona::where('fecha_nacimiento', $request->fechaNacimiento)->get();
        $list2_personas = Persona::where('departamento', $request->departamento)->get();
        $list3_personas = Persona::where('provincia', $request->provincia)->get();
        $list4_personas = Persona::where('distrito', $request->distrito)->get();

        $list_total_personas = $list1_personas->concat($list2_personas)->concat($list3_personas)->concat($list4_personas);

        $result=0;
        foreach ($list_total_personas as $personita) {
            if ($personita == $persona) {
                $result=$result+1;
            }
        }
        if($result==4)
            return redirect()->route('sol-duplicado.create',$persona->DNI);
        else{
            $mensaje = "Los datos Ingresados no son validados";
            return redirect()->route('sol-duplicado.formValidar')->with('respuesta', $mensaje);
        }
    }

    public function create($dni)
    {
        $persona=Persona::findOrFail($dni);
        return view('SolicitudDNI.solDuplicado.create', compact('persona'));
    }

    public function store($dni,Request $request)
    {
        DB::beginTransaction();
        try {
            $persona = Persona::find($request->DNI);
            $solicitud = new SolicitudDNI();
            $solicitud->DNI_Titular = $persona->DNI;
            $solicitud->idTipoSolicitud = '2'; // 2=duplicado
            $solicitud->nombre_solicitante = $persona->Nombres . " " . $persona->Apellido_Paterno;
            $solicitud->solMotivo = $request->motivo;
            $solicitud->solEstado = 'Pendiente';
            $solicitud->solFecha = new DateTime();

            $fechaNac = new DateTime($solicitud->persona->fecha_nacimiento);
            $intervalo = date_diff(new DateTime(), $fechaNac);
            $edad = $intervalo->y;

            if ($edad >= 18) {
                $solicitud->save();
                DB::commit();
                return redirect()->route('sol-duplicado.formValidar')->with('notifica', 'La solicitud de DNI AZUL fue exitosa');
            } else {
                DB::rollback();
                $mensaje= 'El Ciudadano no es mayor de edad';
                return  view('SolicitudDNI.solDuplicado.create', compact('solicitud', 'edad'))->with('notifica', $mensaje);;
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show()
    {
        //return view('SolicitudDNI.solDuplicado.validation');
    }


    // public function edit($id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $solicitud = SolicitudDNI::find($id);
    //         if ($solicitud->solEstado == 'Pendiente') {
    //             DB::commit();
    //             return  view('SolicitudDNI.solPrimera.edit', compact('solicitud'));
    //         } else {
    //             DB::rollback();
    //             $result = 'La solicitud ya esta en proceso, no se puede modificar';
    //             return redirect()->route('sol-primera.index')->with('notifica', $result);;
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         throw $e;
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try{
    //         $persona = Persona::find($request->DNI);
    //         $solicitud = SolicitudDNI::find($id);

    //         $solicitud->DNI_Titular = $persona->DNI;
    //         $solicitud->idTipoSolicitud = '1'; // 1= primera vez
    //         $solicitud->codigo_recibo = $request->codigo_recibo;
    //         $solicitud->codigo_voucher = $request->codigo_voucher;
    //         $solicitud->nombre_solicitante = $persona->Nombres . " " . $persona->Apellido_Paterno;

    //         if ($request->has('valida_foto')) {
    //             $solicitud->valida_foto = 1;
    //         } else {
    //             $solicitud->valida_foto = 0;
    //         }
    //         if ($request->has('valida_firma')) {
    //             $solicitud->valida_firma = 1;
    //         } else {
    //             $solicitud->valida_firma = 0;
    //         }
    //         $solicitud->solMotivo = $request->motivo;
    //         $solicitud->solEstado = 'Pendiente';

    //         $fechaNac = new DateTime($solicitud->persona->fecha_nacimiento);
    //         $intervalo = date_diff(new DateTime(), $fechaNac);
    //         $edad = $intervalo->y;
    //         if ($edad >= 17 && $edad <= 19) {
    //             $solicitud->save();
    //             DB::commit();
    //             return redirect()->route('sol-primera.index')->with('notifica', 'La solicitud fue actualizada');
    //         } else {
    //             DB::rollback();
    //             $condEdad = 'El Ciudadano tiene ' . $edad . ' años, No cumple con el rango (17 - 19) para Solicitar DNI Azul';
    //             return  view('SolicitudDNI.solPrimera.edit', compact('solicitud', 'edad'))->with('notifica', $condEdad);;
    //         }
    //     }catch(Exception $e)
    //     {
    //         DB::rollBack();
    //         throw $e;
    //     }

    // }

    // public function destroy($id)
    // {
    //     $solicitud = SolicitudDNI::find($id);
    //     $solicitud->delete();
    //     return view('ciudadano.index');
    // }


    // public function generaPdf($idSolicitud)
    // {
    //     $solicitud = SolicitudDNI::find($idSolicitud);
    //     $primer_apellido = $solicitud->Persona->Apellido_Paterno;
    //     $nombres = $solicitud->Persona->Nombres;
    //     $pos_2do = strpos($nombres, " ");
    //     $primer_nombre = substr($nombres, 0, $pos_2do - 1);
    //     $segundo_nombre = substr($nombres, $pos_2do);
    //     $linea_detalle = $primer_apellido . "<<" . $primer_nombre . "<" . $segundo_nombre;

    //     for ($i = 1; $i <= 30; $i++) {
    //         if (strlen($linea_detalle) < $i) {
    //             $linea_detalle = $linea_detalle . "<";
    //         }
    //     }
    //     $fecha = date('Y-m-d');
    //     $data = compact('solicitud', 'fecha', 'linea_detalle');
    //     $pdf = Pdf::loadView('SolicitudDNI.solPrimera.dniPdf', $data);

    //     return view('SolicitudDNI/dniPdf',compact('solicitud'));
    //     return $pdf->stream('dni.pdf');
    // }


    public function cancelar()
    {
        return redirect()->route('sol-primera.index');
    }
}
