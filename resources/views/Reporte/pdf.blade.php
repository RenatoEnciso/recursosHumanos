<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            background-image: url("images/fondo_acta.jpg") ;
            background-repeat:no-repeat;
            /* //background-attachment: fixed; */
            background-size: 100%;
        }
        .celda{
            padding: 10px 20px;
            text-align: center
        }
        table{
            text-align: center
        }
    </style>
    <link rel="stylesheet" href="css/tabla.css">
 
</head>
<body>
    <br><br><br><br><br>
    <h2 style="text-align: center;color:rgba(40, 23, 123, 0.75)">REPORTE DE ACTAS PARA ELECCIONES</h2>
    <h4>Empleado: {{Auth::user()->name}}</h4>
    <h4>Cargo: {{Auth::user()->Rol->nombreRol}}</h4>
    <h4>Fecha: {{$fecha}}</h4>
  
    <table class="formato_tabla">
        <thead >
            <tr>
                <th scope="row">N°</th>
                <th scope="row">Dni</th>
                <th scope="row">Apellidos</th>
                <th scope="row">Nombres</th>
                <th scope="row">sexo</th>
                <th scope="row">Direccion</th>
                <th scope="row">Estado civil</th>
                <th scope="row">Nacionalidad</th>
            </tr>
        </thead>
        <tbody >
            @if (count($ciudadanos)<=0)
                <tr>
                    <td colspan="4"><i>:: NO HAY CIUDADANOS ::</i></td>
                </tr>
            @else
                @foreach ($ciudadanos as $item)
                    <tr >
                        <td scope="col">{{$nroCiudadanos}}</td>
                        <td scope="col">{{$item->DNI}}</td>
                        <td scope="col">{{$item->Apellido_Paterno}} {{$item->Apellido_Materno}}</td>
                        <td scope="col">{{$item->Nombres}}</td>
                        <td scope="col">{{$item->sexo}}</td>
                        <td scope="col">{{$item->direccion}}</td>
                        <td scope="col">{{$item->estadocivil}}</td>
                        <td scope="col">{{$item->nacionalidad}}</td>
                    </tr>
                    @php
                        $nroCiudadanos +=1;
                    @endphp
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
