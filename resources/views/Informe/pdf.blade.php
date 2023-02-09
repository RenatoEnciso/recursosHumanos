<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1 style="text-align: center;color:red">INFORME</h1>
    <h4>Empleado: {{Auth::user()->name}}</h4>
    <h4>Cargo: {{Auth::user()->rol}}</h4>
    <h4>
        <?php
           $DateAndTime = date('d-m-Y');
            echo "Fecha: $DateAndTime";
        ?>
    </h4>
    <div>
        <script>
        date = new Date().toLocaleDateString();
        document.write(date);
        </script>
    </div>
    <table class="table" border="1" style="margin-left:auto;margin-right:auto">
        <thead>
            <tr>
                <th scope="col">Dni</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nombres</th>
                <th colspan="3" scope="col">sexo</th>
            </tr>
        </thead>
        <tbody>
            @if (count($persona)<=0)
            <tr>
                <td colspan="4"><i>:: NO HAY REGISTROS ::</i></td>
            </tr>
            @else
                @foreach ($persona as $item)
                <tr>
                    <td>{{$item->DNI}}</td>
                    <td>{{$item->Apellido_Paterno}} {{$item->Apellido_Materno}}</td>
                    <td>{{$item->Nombres}}</td>
                    <td colspan="3">{{$item->sexo}}</td>
                </tr>
                @endforeach
                <p >Detalles e historial del usuario:</p>
                <p>
                    @foreach ($solicitud as $items)
                    <tr>
                        <td colspan="1"><?php
                            if($items->idSolicitud=='1'){
                                echo "Solicito la  acta Nacimiento";
                            }
                            if($items->idSolicitud=='2'){
                                echo "Solicito la  acta Matrimonio";
                            }
                            if($items->idSolicitud=='3'){
                                echo "Solicito la  acta Defunsion";
                            }
                            ?>
                        </td>
                        <td colspan="2">Fecha de la solicitud: {{$items->fechaSolicitud}}</td>
                        <td colspan="3">Observaciones:<br> {{$items->observacion}}</td>
                    </tr><br>
                    @endforeach
                    @foreach ($acta as $itemA)
                    <tr>
                        <td><?php
                            if($itemA->idActa=='1'){
                                echo "*Registro la  acta Nacimiento";
                            }
                            if($itemA->idActa=='2'){
                                echo "*Registro la  acta Matrimonio";
                            }
                            if($itemA->idActa=='3'){
                                echo "*Registro la  acta Defunsion";
                            }
                            ?>
                        </td>
                        <td colspan="5">
                            Estado:
                            <?php
                                if($itemA->estado==0){
                                    echo "Eliminado";
                                }
                                if($itemA->estado==1){
                                    echo "Archivado";
                                }
                            ?>
                        </td>
                    </tr>
                    @endforeach
                <p>
            @endif
        </tbody>
    </table><br>
</body>
</html>
