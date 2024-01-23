<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            max-height: 100vh;
        }

        table {
            font-size: 50%;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid black;
        
        }
        div.container {
    padding-left: 5vw;
    padding-right: 5vw;
    padding-top: 3vh;
    min-height: 100vh;
    overflow-y: auto; /* Permitir desplazamiento vertical si es necesario */
}


        th {
            font-weight: bold;
            text-align: center;
            background-color: #BED4EF;
            padding: 10px;
            border: 1px solid black;
            
        }

        td {
            padding: 10px;
            border: 1px solid black;
            
        }

        div.container {
            padding-left: 5vw;
            padding-right: 5vw;
            padding-top: 3vh;
        }

        @media (max-width: 1600px) {
            div.container {
                padding-left: 2vw;
                padding-right: 2vw;
            }
            
        }
        @media print {
    body {
        transform: scale(0.75);
        transform-origin: top left;
    }
}


        
    </style>
    
</head>
<body>
    <div class="container" style="zoom: 75%" >

    
    <!-- <table>
        <tr><th colspan="2">DATOS DE LA EMPRESA</th></tr>
        <tr><td>RUC:</td><td>20609212102</td></tr>
        <tr><td>RAZÓN SOCIAL:</td><td>MI BOLETA SAC</td></tr>
        <tr><td>RUBRO DE LA EMPRESA:</td><td>Transformación Digital</td></tr>
        <tr><td>DIRECCIÓN:</td><td>Av. Santo Toribio 922</td></tr>
    </table> -->
    <!-- style="border: none #ddd;" -->
    <div style="padding-left:20vw;padding-right:20vw;">
        <table style="background:#98b2dc">
       
            <tr ><td style="border: none;" colspan="6">RUC: 20609212102 </td>
                <td rowspan="4" style="text-align:right;border: none;" colspan="2">
                
                <img src="https://www.itp.gob.pe/wp-content/uploads/2018/02/reniec.png" alt="">

            </td></tr>
            <tr><td style="border: none;">Empleador:{{ Auth::user()->name}}</td></tr>
            <tr><td style="border: none;">Periodo: {{$periodo->month}}/{{$periodo->year}}</td></tr>
            <tr><td style="border: none; "> PDT Planilla Electronica-Plame: {{$periodo->month}}{{$Contrato->idContrato}}{{$periodo->year}}</td></tr>
            <!-- <img src="public/images/Logo-Login.png" alt=""> -->

            
        </table>
        
        <table style="text-align:center">
            <thead  >
                <tr >
                    <th scope="col" colspan="2">Documento de identidad</th>
                    <th scope="col" colspan="4" rowspan="2">Nombres y apellidos</th>
                    <th scope="col" colspan="2" rowspan="2">Situación</th>
                </tr>
                <!-- Add another head section -->
                <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Numero</th>
                </tr>
            </thead>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td>DNI</td>
                    <td>{{$Contrato->trabajador->persona->DNI}}</td>
                    <td colspan="4">{{$Contrato->trabajador->persona->Apellido_Paterno}} {{$Contrato->trabajador->persona->Apellido_Materno}} {{$Contrato->trabajador->persona->Nombres}}</td>
                    <td colspan="2">ACTIVO O SUBSIDIO</td>
                </tr>
    
            </tbody>
    
            <thead>
                <tr>
                    <th scope="col" colspan="2">Fecha de Ingreso</th>
                    <th scope="col" colspan="2" >Tipo de Trabajador</th>
                    <th scope="col" colspan="2" >Regimen Pensionario</th>
                    <th scope="col" colspan="2" >CUSPP</th>
                </tr>
    
            </thead>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="2">{{$Contrato->fecha_inicio}}</td>
                    <td colspan="2">EMPLEADO</td>
                    <td colspan="2">DL 19990-SIS NAC</td>
                    <td colspan="2"></td>
                </tr>
    
            </tbody>
    
            <thead>
                <tr>
                    <th scope="col" colspan="1" rowspan="2">Días Laborales</th>
                    <th scope="col" colspan="1" rowspan="2">Días No Laborales</th>
                    <th scope="col" colspan="1" rowspan="2">Días subsidiarios</th>
                    <th scope="col" colspan="1" rowspan="2">Condición</th>
                    <th scope="col" colspan="2" >Jornada Ordinaria</th>
                    <th scope="col" colspan="2" >Sobretiempo</th>
                </tr>
                <tr>
                   
                    <th scope="col" colspan="1" >Total Horas</th>
                    <th scope="col" colspan="1" >Minutos</th>
    
                    <th scope="col" colspan="1" >Total Horas</th>
                    <th scope="col" colspan="1" >Minutos</th>
                </tr>
    
            </thead>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="1">{{$diasEnMes}}</td>
                    <td colspan="1">{{$diasFeriados}}</td>
                    <td colspan="1">0</td>
                    <td colspan="1">Domiciliado</td>
                    <td colspan="1">{{$horasMes}}</td>
                    <td colspan="1"></td>
                    <td colspan="1">{{$horasExtras}}</td>
                    <td colspan="1"></td>
                </tr>
    
            </tbody>
    
            <thead>
                <tr>
                    <th scope="col" colspan="6" >Motivo de Suspensión de Labores</th>
                    <th scope="col" colspan="2" rowspan="2">Otros empleadores por Rentas de 5ta categoria</th>
                    
    
                    
                </tr>
                <tr>
                   
                    <th scope="col" colspan="1" >Tipo</th>
                    <th scope="col" colspan="4" >Motivo</th>
    
                    <th scope="col" colspan="1" >Nº días</th>
                
                </tr>
    
            </thead>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="1">07</td>
                    <td colspan="4">S.P Falta No Justificada</td>
                    <td colspan="1">{{$diasFaltados}}</td>
                    <td colspan="2">No tiene</td>
                </tr>
            </tbody>
        </table>
        
        <table>
    
            <thead>
                <tr>
                    <th scope="col" colspan="1">Código</th>
                    <th scope="col" colspan="4" >Conceptos</th>
                    <th scope="col" colspan="1" >Igresos S/.</th>
                    <th scope="col" colspan="1" >Descuentos S/.</th>
                    <th scope="col" colspan="1" >Neto S/.</th>
                </tr>
    
            </thead>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr >
                    <td colspan="8" style="background: #98b2dc;">Ingresos</td>
                    
                </tr>
                <tr >
                    <td style="border: none;">0105</td>
                    <td colspan="4" style="border: none;"> TRABAJO DE SOBRETIEMPO (H:EXTRAS 25%)</td>
                    <td style="text-align:right;border: none;">{{$Sobretiempo25}}</td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr >
                    <td style="border: none;">0106</td>
                    <td colspan="4" style="border: none;"> TRABAJO DE SOBRETIEMPO (H:EXTRAS 35%)</td>
                    <td style="text-align:right;border: none;">{{$Sobretiempo35}}</td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
                <tr >
                    <td style="border: none;">0106</td>
                    <td colspan="4" style="border: none;"> REMUNERACION O JORNAL BASICO</td>
                    <td style="text-align:right;border: none;">{{$Contrato->monto}}</td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                </tr>
    
            </tbody>
    
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="8" style="background: #98b2dc;">Descuentos</td>
                    
                </tr>
                <tr>
                    <td style="border: none;">0705</td>
                    <td colspan="4" style="border: none;"> INASISTENCIAS</td>
                    <td style="border: none;"></td>
                    <td style="text-align:right;border: none;">{{$faltasDinero}}</td>
                    <td style="border: none;"></td>
                </tr>
    
            </tbody>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="8" style="background: #98b2dc;">Aportes del Trabajador</td>
                    
                </tr>
                <tr>
                    <td style="border: none;">0605</td>
                    <td style="border: none;" colspan="4"> RENTA QUINTA CATEGORIA RETENCIONES</td>
                    <td style="border: none;"></td>
                    <td style="text-align:right;border: none;">0</td>
                    <td style="border: none;" ></td>
                </tr>
                <tr>
                    <td style="border: none;">0607</td>
                    <td  style="border: none;" colspan="4"> SISTEMA NAC. PENSIONES</td>
                    <td style="border: none;"></td>
                    <td style="text-align:right;border: none;">{{$seguro}}</td>
                    <td style="border: none;" ></td>
                </tr>
    
            </tbody>
            <tbody>
                <!-- First row for "Nombres y apellidos" -->
                <tr>
                    <td colspan="7" style="background: #98b2dc;">Neto a Pagar</td>
                    <td colspan="1" style="background: #BED4EF;text-align:right">{{$neto}}</td>
                </tr>
            
    
            </tbody>
    
        </table>
    
        <table>
            <th colspan="8"  style="text-align:left">
                Aportes de Empleador
            </th>
            <tr>
                <td colspan="1">C804</td>
                <td colspan="5">ESSALUD(REGULAR )</td>
                <td colspan="1" style="text-align:right">{{$salud}}</td>
            </tr>
        </table>
    </div>
</div>
    


</body>
</html>


