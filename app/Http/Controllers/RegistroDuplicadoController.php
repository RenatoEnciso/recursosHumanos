<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SolDniPrimeraVezCreateRequest;
use App\Models\Persona;
use App\Models\SolicitudDNI;
use App\Models\RegistroDNI;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RegistroDuplicadoController extends Controller
{
    const PAGINATION = 10;

    public function index(Request $request)
    {
         $buscarpor = $request->get('buscarpor');
        $registros = RegistroDNI::select('*')
            ->join('persona as p', 'p.DNI', '=', 'registro_dni.DNI')
            ->join('solicitud_dni as sd', 'sd.idSolicitud', '=', 'registro_dni.idSolicitudDNI')
            ->join('tipo_solicitud_dni as ts', 'ts.idTipoSolicitud', '=', 'sd.idTipoSolicitud')
            ->where('ts.idTipoSolicitud', 2) // 2= duplicado
            ->where('Nombres', 'like', '%' . $buscarpor . '%')
            ->paginate($this::PAGINATION);

        $solicitudes = SolicitudDNI::select('*')
            ->join('tipo_solicitud_dni as ts', 'ts.idTipoSolicitud', '=', 'solicitud_dni.idTipoSolicitud')
            ->where('solicitud_dni.solEstado', 'Pendiente')
            ->where('ts.idTipoSolicitud', 2)->get(); // 2= duplicado
        return view('RegistroDNI.regDuplicado.index', compact('registros', 'solicitudes', 'buscarpor'));
    }

    

    public function createValido(Request $request, $idSolicitud)
    {
        DB::beginTransaction();
        try {
            $solicitud = SolicitudDNI::find($idSolicitud);
            $persona = Persona::find($solicitud->DNI_Titular);
            if ($persona) {
                $solicitud->solEstado = 'En Proceso';
                $solicitud->save();
                $registro = new RegistroDNI();
                $registro->idTipoDni = 2;   // 2=duplicado
                $registro->regEstado = 0; // 0 = No registrado
                $registro->idSolicitudDNI = $solicitud->idSolicitud;
                $registro->DNI = $solicitud->DNI_Titular;
                $registro->save();
                DB::commit();
                return view('RegistroDNI.regDuplicado.create', compact('persona', 'solicitud', 'registro'));
            } else {
                DB::rollBack();
                return redirect()->route('reg-duplicado.index')->with('notifica', 'El ciudadano no existe en la base de datos');
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Horror: " . $e->getMessage());
        }
    }

    public function conexionSunat(){
        // $data = [
        //     {
        //         "personaId": "65aa413cc6cbdb00148fe25d",
        //         "personaToken": "DEV_... ---> aquí va tu 'personaToken'",
        //         "fileName": "20202020202-03-B001-00000001",
        //         "documentBody": {
        //             "cbc:UBLVersionID": {
        //                 "_text": "2.1"
        //             },
        //             "cbc:CustomizationID": {
        //                 "_text": "2.0"
        //             },
        //             "cbc:ID": {
        //                 "_text": "B001-00000001"
        //             },
        //             "cbc:IssueDate": {
        //                 "_text": "2024-01-19"
        //             },
        //             "cbc:IssueTime": {
        //                 "_text": "05:51:23"
        //             },
        //             "cbc:InvoiceTypeCode": {
        //                 "_attributes": {
        //                     "listID": "0101"
        //                 },
        //                 "_text": "03"
        //             },
        //             "cbc:Note": [
        //                 {
        //                     "_text": "TREINTA CON 00/100 SOLES",
        //                     "_attributes": {
        //                         "languageLocaleID": "1000"
        //                     }
        //                 }
        //             ],
        //             "cbc:DocumentCurrencyCode": {
        //                 "_text": "PEN"
        //             },
        //             "cac:AccountingSupplierParty": {
        //                 "cac:Party": {
        //                     "cac:PartyIdentification": {
        //                         "cbc:ID": {
        //                             "_attributes": {
        //                                 "schemeID": "6"
        //                             },
        //                             "_text": "20202020202"
        //                         }
        //                     },
        //                     "cac:PartyName": {
        //                         "cbc:Name": {
        //                             "_text": "RENIEC"
        //                         }
        //                     },
        //                     "cac:PartyLegalEntity": {
        //                         "cbc:RegistrationName": {
        //                             "_text": "REGIST. NAC. DE IDENTIF. Y ESTADO CIVIL"
        //                         },
        //                         "cac:RegistrationAddress": {
        //                             "cbc:AddressTypeCode": {
        //                                 "_text": "0000"
        //                             },
        //                             "cac:AddressLine": {
        //                                 "cbc:Line": {
        //                                     "_text": "Jr. Bolivia Nro. 109"
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             },
        //             "cac:AccountingCustomerParty": {
        //                 "cac:Party": {
        //                     "cac:PartyIdentification": {
        //                         "cbc:ID": {
        //                             "_attributes": {
        //                                 "schemeID": "1"
        //                             },
        //                             "_text": "00000000"
        //                         }
        //                     },
        //                     "cac:PartyLegalEntity": {
        //                         "cbc:RegistrationName": {
        //                             "_text": "---"
        //                         }
        //                     }
        //                 }
        //             },
        //             "cac:TaxTotal": {
        //                 "cbc:TaxAmount": {
        //                     "_attributes": {
        //                         "currencyID": "PEN"
        //                     },
        //                     "_text": 4.58
        //                 },
        //                 "cac:TaxSubtotal": [
        //                     {
        //                         "cbc:TaxableAmount": {
        //                             "_attributes": {
        //                                 "currencyID": "PEN"
        //                             },
        //                             "_text": 25.42
        //                         },
        //                         "cbc:TaxAmount": {
        //                             "_attributes": {
        //                                 "currencyID": "PEN"
        //                             },
        //                             "_text": 4.58
        //                         },
        //                         "cac:TaxCategory": {
        //                             "cac:TaxScheme": {
        //                                 "cbc:ID": {
        //                                     "_text": "1000"
        //                                 },
        //                                 "cbc:Name": {
        //                                     "_text": "IGV"
        //                                 },
        //                                 "cbc:TaxTypeCode": {
        //                                     "_text": "VAT"
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 ]
        //             },
        //             "cac:LegalMonetaryTotal": {
        //                 "cbc:LineExtensionAmount": {
        //                     "_attributes": {
        //                         "currencyID": "PEN"
        //                     },
        //                     "_text": 25.42
        //                 },
        //                 "cbc:TaxInclusiveAmount": {
        //                     "_attributes": {
        //                         "currencyID": "PEN"
        //                     },
        //                     "_text": 30
        //                 },
        //                 "cbc:PayableAmount": {
        //                     "_attributes": {
        //                         "currencyID": "PEN"
        //                     },
        //                     "_text": 30
        //                 }
        //             },
        //             "cac:InvoiceLine": [
        //                 {
        //                     "cbc:ID": {
        //                         "_text": 1
        //                     },
        //                     "cbc:InvoicedQuantity": {
        //                         "_attributes": {
        //                             "unitCode": "ZZ"
        //                         },
        //                         "_text": 1
        //                     },
        //                     "cbc:LineExtensionAmount": {
        //                         "_attributes": {
        //                             "currencyID": "PEN"
        //                         },
        //                         "_text": 25.42
        //                     },
        //                     "cac:PricingReference": {
        //                         "cac:AlternativeConditionPrice": {
        //                             "cbc:PriceAmount": {
        //                                 "_attributes": {
        //                                     "currencyID": "PEN"
        //                                 },
        //                                 "_text": 30
        //                             },
        //                             "cbc:PriceTypeCode": {
        //                                 "_text": "01"
        //                             }
        //                         }
        //                     },
        //                     "cac:TaxTotal": {
        //                         "cbc:TaxAmount": {
        //                             "_attributes": {
        //                                 "currencyID": "PEN"
        //                             },
        //                             "_text": 4.58
        //                         },
        //                         "cac:TaxSubtotal": [
        //                             {
        //                                 "cbc:TaxableAmount": {
        //                                     "_attributes": {
        //                                         "currencyID": "PEN"
        //                                     },
        //                                     "_text": 25.42
        //                                 },
        //                                 "cbc:TaxAmount": {
        //                                     "_attributes": {
        //                                         "currencyID": "PEN"
        //                                     },
        //                                     "_text": 4.58
        //                                 },
        //                                 "cac:TaxCategory": {
        //                                     "cbc:Percent": {
        //                                         "_text": 18
        //                                     },
        //                                     "cbc:TaxExemptionReasonCode": {
        //                                         "_text": "10"
        //                                     },
        //                                     "cac:TaxScheme": {
        //                                         "cbc:ID": {
        //                                             "_text": "1000"
        //                                         },
        //                                         "cbc:Name": {
        //                                             "_text": "IGV"
        //                                         },
        //                                         "cbc:TaxTypeCode": {
        //                                             "_text": "VAT"
        //                                         }
        //                                     }
        //                                 }
        //                             }
        //                         ]
        //                     },
        //                     "cac:Item": {
        //                         "cbc:Description": {
        //                             "_text": "Solicitud de DNI Azul por Primera Vez"
        //                         }
        //                     },
        //                     "cac:Price": {
        //                         "cbc:PriceAmount": {
        //                             "_attributes": {
        //                                 "currencyID": "PEN"
        //                             },
        //                             "_text": 25.4237288136
        //                         }
        //                     }
        //                 }
        //             ]
                
        //         }
        //     }
        
        // ];

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'personaId' => '65aa413cc6cbdb00148fe25d',
        //     'personaToken' => 'DEV_XteBIQ17EBekibrpE5XuSvvmQd97ZqwyXnf9704dEd6ahzkZ9XBJS36X1B9PJqFK',
        // ])->post('https://api.sunat.gob.pe/v1/sendDocument', $data);

        // if($response->successful()) {
        //     dd($response->json());
        // } else {
        //     dd($response->error());
        // }

        // $response = Http::withHeaders([
        //     'personaId' => '65aa413cc6cbdb00148fe25d',
        //     'personaToken' => 'DEV_XteBIQ17EBekibrpE5XuSvvmQd97ZqwyXnf9704dEd6ahzkZ9XBJS36X1B9PJqFK',
        //     ])->get('https://api.sunat.gob.pe/URL/documents/tu-document-id/getPDF/pdf/nombre-del-archivo.pdf');
        
        // $data = $response->json();

    }



    // public function storeValido(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $registro = RegistroDNI::find($id);
    //         $solicitud = SolicitudDNI::find($registro->idSolicitudDNI);
    //         $persona= Persona::find($registro->DNI);
    //         $registro->DNI = $request->DNI;
    //         $registro->direccion = $request->direccion;
    //         $foto = $request->file('file_foto');
    //         if ($foto) {
    //             $nombreArchivo = $registro->persona->Nombres . '.' . $foto->getClientOriginalExtension();
    //             Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
    //             $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
    //             $registro->file_foto = $urlFoto;
    //         }

    //         $firma = $request->file('file_firma');
    //         if ($firma) {
    //             $nombreArchivo = $registro->persona->Nombres . '.' . $firma->getClientOriginalExtension();
    //             Storage::put('public/primeraVez/FirmasDNI/' . $nombreArchivo, file_get_contents($firma));   //guardar en storage
    //             $urlfirma = Storage::url('public/primeraVez/FirmasDNI/' . $nombreArchivo);  //obtener url de foto
    //             $registro->file_firma = $urlfirma;
    //         }
    //         $registro->idSolicitudDNI = $solicitud->idSolicitud;
    //         $registro->regFecha =  new DateTime();
    //         $registro->dniFechaEmision = (clone $registro->regFecha)->modify('+15 days');
    //         $registro->dniFechaCaducidad = (clone $registro->dniFechaEmision)->modify('+7 years');
    //         $registro->regEstado = 1;       //1= registrado
    //         if ($registro->save()) {
    //             $solicitud->solEstado = "Aceptado";
    //             $solicitud->save();
    //             DB::commit();
    //             return redirect()->route('reg-primera.index')->with('notifica', 'La solicitud de DNI AZUL fue exitosa');
    //         } else {
    //             DB::rollBack(); 
    //             $result='No se pudo guardar el registro';
    //             return view('RegistroDNI.regPrimera.create', compact('persona', 'solicitud', 'registro'))->with('notifica',$result);
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         throw new Exception("Horror: " . $e->getMessage());
    //     }
    // }

    // public function edit($id)
    // {
    //     $registro = RegistroDNI::find($id);
    //     $solicitud = SolicitudDNI::find($registro->idSolicitudDNI);
    //     $persona = Persona::find($registro->DNI);
    //     return view('RegistroDNI.regPrimera.edit', compact('registro', 'persona', 'solicitud'));
    // }

    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try{
            
    //         $registro = RegistroDNI::find($id);
    //         $solicitud = SolicitudDNI::find($registro->idSolicitudDNI);
    //         $registro->DNI = $request->DNI;
    //         $registro->idTipoDni = 1;  // 1= Primera vez
    //         $registro->direccion = $request->direccion;
    //         $registro->regFecha =  new DateTime();
    //         $registro->dniFechaEmision = (clone $registro->regFecha)->modify('+15 days');
    //         $registro->dniFechaCaducidad = (clone $registro->dniFechaEmision)->modify('+7 years');
    
    //         $foto = $request->file('file_foto');
    //         if ($foto) {
    //             $nombreArchivo = $registro->persona->Apellido_Paterno . '.' . $foto->getClientOriginalExtension();
    //             Storage::put('public/primeraVez/FotosDNI/' . $nombreArchivo, file_get_contents($foto));   //guardar en storage
    //             $urlFoto = Storage::url('public/primeraVez/FotosDNI/' . $nombreArchivo);  //obtener url de foto
    //             $registro->file_foto = $urlFoto;
    //         }
    
    //         $firma = $request->file('file_firma');
    //         if ($firma) {
    //             $nombreArchivo = $registro->persona->Nombres . '.' . $firma->getClientOriginalExtension();
    //             Storage::put('public/primeraVez/FirmasDNI/' . $nombreArchivo, file_get_contents($firma));   //guardar en storage
    //             $urlfirma = Storage::url('public/primeraVez/FirmasDNI/' . $nombreArchivo);  //obtener url de foto
    //             $registro->file_firma = $urlfirma;
    //         }
    //         $registro->regEstado = 1;  // 1=registrado
    //         if($registro->save()){
    //             $solicitud->solEstado = "Aceptado";
    //             $solicitud->save();
    //             DB::commit();
    //             return redirect()->route('reg-primera.index')->with('notifica', 'La actualizacion fue exitosa');
    //         }else{
    //             DB::rollBack(); 
    //             $result='No se pudo Actualizar el registro';
    //             return view('RegistroDNI.regPrimera.edit', compact('persona', 'solicitud', 'registro'))->with('notifica',$result);
    //         }
  
    //     }
    //     catch(Exception $e){
    //         throw new Exception("Horror: " . $e->getMessage());
    //     }

    // }

    // public function generaPdf($idRegistro)
    // {
    //     $registro = RegistroDNI::find($idRegistro);

    //     $primer_apellido = $registro->Persona->Apellido_Paterno;
    //     $nombres = $registro->Persona->Nombres;
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
    //     $data = compact('registro', 'fecha', 'linea_detalle');
    //     $pdf = Pdf::loadView('RegistroDNI.regPrimera.dniPdf', $data);

    //     //return view('SolicitudDNI/dniPdf',compact('solicitud'));
    //     return $pdf->stream('dni.pdf');
    // }


    // public function cancelar()
    // {
    //     return redirect()->route('reg-primera.index');
    // }

}
