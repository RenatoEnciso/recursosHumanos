<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acta de nacimiento</title>
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
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        {{-- <img src="images/Logo-Login.png" alt="p" width="20%"> --}}
        <div style="text-align: center; color: rgb(6, 40, 108);">
            <h1 id="titulo" style="margin-left:10px ">Acta de Nacimiento</h1>
        </div><br>
        <div>
            <div>
                <div style="display: inline-block">
                    
                    
                            <label> <strong> Fecha de Nacimiento: {{$actaGenerada->actanacimiento->fecha_nacimiento}}</strong> </label>
                          
                       
                   
                </div>
                
            </div>
            <br>
            <div>
                    <label for=""><strong>Localidad: {{$actaGenerada->localidad}} </strong>  </label>
    
            </div>
            <br>
            <div>
              <label for=""> <strong> Lugar de Ocurrencia: {{$actaGenerada->lugar_ocurrencia}}</strong> </label>  
            </div>
            <br>
           <div>
            <label for=""> <strong>Sexo: {{$actaGenerada->actanacimiento->sexo}}</strong>  </label>
           </div>
            
            <br>
           
            <table >
                <thead>
                    <tr>
                        <th scope="row" >Nombres</th>
                        <th scope="col" width="80%" colspan="2" >{{$actaGenerada->actanacimiento->nombres}}</th>
                    </tr>
                </thead>
                <TBody>
                    <tr>
                        <th scope="col" >DATOS DE LOS PADRES</th>
                        <th scope="col">PADRE</th>
                        <th scope="col">MADRE</th>
                    </tr>
                    <TR>
                        <th scope="row" >Pronombres</th>
                        @foreach ($actaPersona as $acta )
                            @if ( ($actaGenerada->actanacimiento->DNIPadre==$acta->DNI))
                                <td>{{$acta->Persona->Nombres}}</td>
                            @else
                                @if ( ($actaGenerada->actanacimiento->DNIMadre==$acta->DNI))
                                <td>{{$acta->Persona->Nombres}}</td>
                                @endif
                                
                            @endif 
                        @endforeach
                        
                        
                    </TR>
                    <tr>
                        <th scope="row" >Primer Apellido</th>
                        @foreach ($actaPersona as $acta )
                        @if ( ($actaGenerada->actanacimiento->DNIPadre==$acta->DNI))
                            <td>{{$acta->Persona->Apellido_Paterno}}</td>
                        @else
                            @if ( ($actaGenerada->actanacimiento->DNIMadre==$acta->DNI))
                            <td>{{$acta->Persona->Apellido_Paterno}}</td>
                            @endif
                            
                        @endif 
                    @endforeach
                    </tr>
                    <tr>
                        <th scope="row" >Segundo Apellido</th>
                        @foreach ($actaPersona as $acta )
                        @if ( ($actaGenerada->actanacimiento->DNIPadre==$acta->DNI))
                            <td>{{$acta->Persona->Apellido_Materno}}</td>
                        @else
                            @if ( ($actaGenerada->actanacimiento->DNIMadre==$acta->DNI))
                            <td>{{$acta->Persona->Apellido_Materno}}</td>
                            @endif
                            
                        @endif 
                    @endforeach
                    </tr>
                    <tr>
                        <th scope="row" >Nacionalidad</th>
                        @foreach ($actaPersona as $acta )
                            @if ( ($actaGenerada->actanacimiento->DNIPadre==$acta->DNI))
                                <td>{{$acta->Persona->nacionalidad}}</td>
                            @else
                                @if ( ($actaGenerada->actanacimiento->DNIMadre==$acta->DNI))
                                <td>{{$acta->Persona->nacionalidad}}</td>
                                @endif
                                
                            @endif 
                        @endforeach
                    </tr>
                    <tr>
                        <th scope="row" >Documento de Identidad</th>
                        <td>{{$actaGenerada->actanacimiento->DNIPadre}}</td>
                        <td>{{$actaGenerada->actanacimiento->DNIMadre}}</td>
                    </tr>
                </TBody>
                
                <tfoot>
                    <tr>
                        <th scope="row" >Domicilio de la madre</th>
                        <td colspan="2"> {{$actaGenerada->actanacimiento->domicilio}}</td>
                    </tr>
                </tfoot>
                

            </table>
            <BR></BR>
            <label for=""> <strong>FICHA DE REGISTRO: {{$actaGenerada->fecha_registro}}</strong>  </label> 
            <BR></BR>
            <label for=""> <strong>REGISTRADOR: {{$actaGenerada->nombreRegistradorCivil}} </strong> </label>
            <BR></BR>
            <label for=""><strong> OBSERVACIONES: {{$actaGenerada->observacion}}</strong> </label>
          
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