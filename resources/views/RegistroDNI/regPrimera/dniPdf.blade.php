<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DNI</title>
    <style>
        .container{
            position: relative;
            top: 100px;
            left: 100px;
       
            width: 500px;
            height: 850px;
        }
        .anverso {
            position: relative;
            top: 0;
            left: 0;
            background-image: url("images/SolicitudDNI/dni-anverso.png");
            background-repeat: no-repeat;
            background-size: 500px 325px;
            width: 500px;
            height: 325px;
        }

        .reverso {
            position: relative;
            top: 100;
            left: 0;
            background-image: url("images/SolicitudDNI/dni-reverso.png");
            background-repeat: no-repeat;
            background-color: aqua;
            background-size: 500px 325px;
            width: 500px;
            height: 325px;
        }

        .foto {
            position: absolute;
            top: 60px;
            left: 38px;
        }
        .anv_Apellido_Paterno{
            position: absolute;
            top: 52px;
            left: 140px;
            text-transform: uppercase;
            font-size: 12px;
        }
        .anv_Apellido_Paterno_foto{
            position: absolute;
            top: 178px;
            left: 42px;
            color: red;
            text-transform: uppercase;
            font-size: 10px;
        }
        .anv_Apellido_Materno{
            position: absolute;
            top: 87px;
            left: 140px;
            text-transform: uppercase;
            font-size: 12px;
        }
        .anv_Nombres{
            position: absolute;
            top: 119px;
            left: 140px;
            text-transform: uppercase;
            font-size: 12px;
        }
        .anv_fecha_nacimiento{
            position: absolute;
            top: 152px;
            left: 140px;
            font-size: 11px;
        }
        .anv_DNI_head{
            position: absolute;
            top: 20px;
            left: 380px;
            color: red;
        }
        .anv_DNI_foto{
            position: absolute;
            top: 95px;
            transform: rotate(90deg);
            left:0px;
            color: red;
            letter-spacing: 2px;
        }
        .anv_DNI_detalle{
            position: absolute;
            top: 203px;
            left: 110px;
            font-weight: bold;
            font-size: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .anv_linea_detalle{
            position: absolute;
            top: 250px;
            left: 38px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="anverso">
            {{-- <img src="images/SolicitudDNI/dni-anverso.png" alt=""> --}}
            <img class="foto" src="{{ public_path($solicitud->file_foto) }}" alt="" width="98px" height="135px">
            <p class="anv_Apellido_Paterno">{{$solicitud->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Paterno_foto">{{$solicitud->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Materno">{{$solicitud->Persona->Apellido_Materno}}</p>
            <p class="anv_Nombres">{{$solicitud->Persona->Nombres}}</p>
            <p class="anv_fecha_nacimiento">{{$solicitud->Persona->fecha_nacimiento}}</p>
            <p class="anv_DNI_head">{{$solicitud->Persona->DNI}}</p>
            <p class="anv_DNI_foto">{{$solicitud->Persona->DNI}}</p>
            <p class="anv_DNI_detalle">{{$solicitud->Persona->DNI}}</p>
            <p class="anv_linea_detalle">{{$linea_detalle}}</p>
          
        </div>
        <div class="reverso">
            {{-- <img src="images/SolicitudDNI/dni-reverso.png" alt=""> --}}
        </div>
    </div>
</body>

</html>
