<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acta de matrimonio</title>
    <style>
        .celda{
            padding: 10px 20px;
            text-align: center
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="text-align: center; color: rgb(6, 40, 108);">
            <h1 id="titulo" style="margin-left:10px ">ACTA DE MATRIMONIO</h1>
        </div><br>
    </div>
    <div>
            <div>
                <div style="display: inline-block">
                    <table border="1" width="140%">
                        <tr>
                            <th>Fecha de Registro</th>
                            <td>{{$actaGenerada->fecha_registro}}</td>
                        </tr>
                    </table>
                </div>
                <div style="display: inline-block; margin-left: 32%">
                    <table border="1" width="140%">
                        <tr>
                            <th>Hora de registro</th>
                            <td>{{$actaGenerada->hora_registro}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <table border="1" width="100%">
                <tr>
                    <th class="titulo">libro</th>
                    <th class="titulo">folio</th>
                    <th class="titulo">observacion</th>
                    <th class="titulo">lugar</th>
                    {{-- <td class="titulo"></td> --}}
                </tr>
                <tr>
                    <td class="contenido">{{$actaGenerada->Libro->nroLibro}}</td>
                    <td class="contenido">{{$actaGenerada->Folio->nroFolio}}</td>
                    <td class="contenido">{{$actaGenerada->observacion}}</td>
                    <td>{{$actaGenerada->lugar_Acta}}</td>
                </tr>
            </table>
            <br>
            DATOS DEL CONTRAYENTE
            <br>
            <table border="1" width="100%">
                <tr>
                    
                    <th class="titulo">Nombre</th>
                    <th class="titulo">Apellido Paterno</th>
                    <th class="titulo">Apellido Materno</th>
                    <th class="titulo">Sexo</th>
                    {{-- <td class="titulo"></td> --}}
                </tr>
                <tr>
                    @foreach ($ActaMatrimonio as $item2)
                    @if (($actaPersona->Acta->idActa)==($item2->Acta->idActa) && ($actaPersona->Persona->DNI)!=($item2->Persona->DNI))
                    <td class="contenido">{{$item2->Persona->Nombres}}</td>
                    <td class="contenido">{{$item2->Persona->Apellido_Paterno}}</td>
                    <td class="contenido">{{$item2->Persona->Apellido_Materno}}</td>
                    <td>{{$item2->Persona->sexo}}</td>
                    @endif
                    @endforeach
                </tr>
            </table>
            <br>
            DATOS DE LA CONTRAYENTE
            <br>
            <table border="1" width="100%">
                <tr>
                    <th class="titulo">Nombre</th>
                    <th class="titulo">Apellido Paterno</th>
                    <th class="titulo">Apellido Materno</th>
                    <th class="titulo">Sexo</th>
                    {{-- <td class="titulo"></td> --}}
                </tr>
                <tr>
                    <td class="contenido">{{$actaPersona->Persona->Nombres}}</td>
                    <td class="contenido">{{$actaPersona->Persona->Apellido_Paterno}}</td>
                    <td class="contenido">{{$actaPersona->Persona->Apellido_Materno}}</td>
                    <td>{{$actaPersona->Persona->sexo}}</td>
                </tr>
            </table>
            <br>
            
            
                
            
        </div><br>
        <div style="text-align: center">
            <img src="images/firma.png" alt="firma" width="15%" style="margin: 0;padding: 0"><br>
            <label>___________________________</label><br>
            <label>Director general de RENIEC</label>
        </div>
    </div>
</body>
</html>