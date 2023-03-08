<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/tabla.css">
</head>
<body>

    <h1 style="text-align: center;color:red">REPORTE DE ACTAS PARA ELECCIONES</h1>
    <h4>Empleado: {{Auth::user()->name}}</h4>
    <h4>Cargo: {{Auth::user()->Rol->nombreRol}}</h4>
    <h4>Fecha: {{$fecha}}</h4>
  
    <table >
        <thead >
            <tr>
                <th scope="row">Dni</th>
                <th scope="row">Apellidos</th>
                <th scope="row">Nombres</th>
                <th scope="row">sexo</th>
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
                        <td scope="col">{{$item->DNI}}</td>
                        <td scope="col">{{$item->Apellido_Paterno}} {{$item->Apellido_Materno}}</td>
                        <td scope="col">{{$item->Nombres}}</td>
                        <td scope="col">{{$item->sexo}}</td>
                        <td scope="col">{{$item->estadocivil}}</td>
                        <td scope="col">{{$item->nacionalidad}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
