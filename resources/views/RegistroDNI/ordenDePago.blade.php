<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .celda{
            padding: 10px 20px;
            text-align: center
        }
    </style>
</head>
<body>
    <div class="container" style="border: solid rgb(6, 40, 108); border-radius:10px; padding: 20px 15px">
        <div style="display: inline-block">
            <h1 id="titulo" style="margin-left:10px ">RENIEC</h1>
        </div>
        <div style="display: inline-block; float: right; text-align: center; border: solid black; border-radius:10px; padding: 10px 20px; font-size: 150%" >
            Orden de pago <br>
            N° {{$solicitud->idSolicitud}}
        </div><br>
        <span style="font-family: 200%; margin-top: 50px"> <b style="margin-left: 8px">DATOS GENERALES</b></span>
       <div style="margin-top: 5px; border: solid black; border-radius:10px; padding: 10px 15px ">
        Fecha: {{$solicitud->fechaSolicitud}} <br>
        DNI: {{$solicitud->Persona->DNI}} <br>
        Nombre: {{$solicitud->Persona->Nombres}} {{$solicitud->Persona->Apellido_Paterno}} {{$solicitud->Persona->Apellido_Materno}}<br>
        Observación: {{$solicitud->observacion}}
       </div>
       <div style="margin-top: 20px; border: solid black; border-radius:10px; padding: 10px 15px">
            <table border="black" style="margin: 0 auto">
                <tr>
                    <th class="celda">Id del Acta</th>
                    <th class="celda">Fecha de Registro</th>
                    <th class="celda">Observacion</th>
                    <th class="celda">Tipo de Acta</th>
                    <th class="celda">Importe</th>
                </tr>
                @foreach ($solicitud->Lista_Solicitud as $item)
                    <tr>
                        <td class="celda">{{$item->Acta->idActa}}</td>
                        <td class="celda">{{$item->Acta->fecha_registro}}</td>
                        <td class="celda">{{$item->Acta->observacion}}</td>
                        <td class="celda">{{$item->Acta->TipoActa->nombre}}</td>
                        <td class="celda">S/12</td>
                    </tr>
                @endforeach
            </table>
       </div>
       <div style="margin: 15px 10px;text-align: right">
        <b>IMPORTE TOTAL = {{12*count($solicitud->Lista_Solicitud)}}</b>
       </div>
    </div>
</body>
</html>