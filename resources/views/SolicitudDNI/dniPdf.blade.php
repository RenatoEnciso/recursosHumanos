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
        }
        .anv_Apellido_Materno{
            position: absolute;
            top: 82px;
            left: 140px;
        }
        .anv_Nombres{
            position: absolute;
            top: 112px;
            left: 140px;
        }
        .anv_DNI_horizontal{
            position: absolute;
            top: 20px;
            left: 380px;
            color: red;
        }
        .anv_DNI_vertical{
            position: absolute;
            top: 85px;
            transform: rotate(90deg);
            left: 7px;
            color: red;
        }
        .anv_DNI_detalle{
            position: absolute;
            top: 200px;
            left: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="anverso">
            {{-- <img src="images/SolicitudDNI/dni-anverso.png" alt=""> --}}
            <img class="foto" src="{{ public_path($solicitud->file_foto) }}" alt="" width="98px" height="135px">
            <p class="anv_Nombres">{{$solicitud->Persona->Nombres}}</p>
            <p class="anv_Apellido_Paterno">{{$solicitud->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Paterno_foto">{{$solicitud->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Materno">{{$solicitud->Persona->Apellido_Materno}}</p>
            <p class="anv_DNI_horizontal">{{$solicitud->Persona->DNI}}</p>
            <p class="anv_DNI_vertical">{{$solicitud->Persona->DNI}}</p>
            <p class="anv_DNI_detalle">{{$solicitud->Persona->DNI}}</p>
        </div>
        <div class="reverso">
            {{-- <img src="images/SolicitudDNI/dni-reverso.png" alt=""> --}}
        </div>
    </div>
</body>

</html>
