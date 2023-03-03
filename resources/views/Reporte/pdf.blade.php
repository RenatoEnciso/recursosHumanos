<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1 style="text-align: center;color:red">REPORTE DE ACTAS</h1>
    <h4>Empleado: {{Auth::user()->name}}</h4>
    <h4>Cargo: {{Auth::user()->Rol->nombreRol}}</h4>
  
    <table >
        <thead >
            <tr>
                <th scope="col">Dni</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nombres</th>
                <th colspan="3" scope="col">sexo</th>
            </tr>
        </thead>
        <tbody >
            @if (count($personas)<=0)
                <tr>
                    <td>{{$item->DNI}}</td>
                    <td>{{$item->Apellido_Paterno}} {{$item->Apellido_Materno}}</td>
                    <td>{{$item->Nombres}}</td>
                    <td colspan="3">{{$item->sexo}}</td>
                </tr>
            @else
                @foreach ($personas as $item)
                    <tr >
                        <td scope="col">{{$item->DNI}}</td>
                        <td scope="col">{{$item->Apellido_Paterno}} {{$item->Apellido_Materno}}</td>
                        <td scope="col">{{$item->Nombres}}</td>
                        <td scope="col">{{$item->sexo}}</td>
                        <td scope="col">{{$item->estadocivil}}</td>
                        <td scope="col">{{$item->nacionalidad}}</td>
                    </tr>
                    @endforeach
                <p>
            @endif
        </tbody>
    </table><br>
</body>
</html>
