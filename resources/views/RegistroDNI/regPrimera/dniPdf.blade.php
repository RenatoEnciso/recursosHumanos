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
        .anv_sexo{
            position: absolute;
            top: 178px;
            left:140px;
            font-size: 10px;
        }
        .anv_estado_civil{
            position: absolute;
            top: 178px;
            left:195px;
            font-size: 10px;
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
        .firma{
            position: absolute;
            top: 170px;
            left: 300px;
        }
        .anv_fecha_inscripcion{
            position: absolute;
            top: 60px;
            left: 400px;
            font-size: 10px;
        }
        .anv_fecha_emision{
            position: absolute;
            top: 87px;
            left: 400px;
            font-size: 10px;
        }
        .anv_fecha_caducidad{
            position: absolute;
            top: 115px;
            left:400px;
            font-size: 10px;
        }
        .rev_departamento{
            position: absolute;
            top: 115px;
            left:20px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 15px;

        }
        .rev_provincia{
            position: absolute;
            top: 115px;
            left:150px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 15px;
        }
        .rev_distrito{
            position: absolute;
            top: 115px;
            left:300px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 15px;
        }
        .rev_direccion{
            position: absolute;
            top: 145px;
            left:20px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 15px;
        }
    </style>
</head>

@php
use Carbon\Carbon;
@endphp

<body>
    <div class="container">
        <div class="anverso">
            <img class="foto" src="{{ public_path($registro->file_foto) }}" alt="" width="98px" height="135px">
            <p class="anv_Apellido_Paterno">{{$registro->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Paterno_foto">{{$registro->Persona->Apellido_Paterno}}</p>
            <p class="anv_Apellido_Materno">{{$registro->Persona->Apellido_Materno}}</p>
            <p class="anv_Nombres">{{$registro->Persona->Nombres}}</p>
            <p class="anv_fecha_nacimiento">{{Carbon::parse($registro->Persona->fecha_nacimiento)->format('d m Y')}}</p>
            <p class="anv_DNI_head">{{$registro->Persona->DNI}}</p>
            <p class="anv_DNI_foto">{{$registro->Persona->DNI}}</p>
            <p class="anv_DNI_detalle">{{$registro->Persona->DNI}}</p>
            <p class="anv_sexo">{{$registro->Persona->sexo}}</p>
            <p class="anv_estado_civil">{{$registro->Persona->estadocivil}}</p>
            <p class="anv_linea_detalle">{{$linea_detalle}}</p>
            <img class="firma" src="{{ public_path($registro->file_firma) }}" alt="" width="80x" height="40px"> 
            <p class="anv_fecha_inscripcion">{{ Carbon::parse($registro->regFecha)->format('d m Y')}}</p>
            <p class="anv_fecha_emision">{{ Carbon::parse($registro->dniFechaEmision)->format('d m Y')}}</p>
            <p class="anv_fecha_caducidad">{{ Carbon::parse($registro->dniFechaCaducidad)->format('d m Y') }}</p>
        </div>
        <div class="reverso">
            <p class="rev_departamento">{{$registro->Persona->departamento}}</p>
            <p class="rev_provincia">{{$registro->Persona->provincia}}</p>
            <p class="rev_distrito">{{$registro->Persona->distrito}}</p>
            <p class="rev_direccion">{{$registro->Persona->direccion}}</p>
        </div>
    </div>
</body>

</html>
