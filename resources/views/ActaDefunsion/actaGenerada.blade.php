<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acta de Defunción</title>
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
            <h1 id="titulo" style="margin-left:10px ">Acta de Defunción</h1>
        </div><br>
        <div>
            <div>
                <div style="display: inline-block">
                    
                    
                            <label> <strong> Fecha de fallecimiento: {{$actaGenerada->ActaDefunsion->fecha_fallecido}}</strong> </label>
                          
                       
                   
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
          
            
            <br>
           
            <table >
               
                <TBody>
                    <tr>
                        <th scope="col" >DATOS </th>
                        <th scope="col">FALLECIDO</th>
                    </tr>
                    <TR>
                        <th scope="row" >Pronombres</th>
                        
                            @if ( ($actaGenerada->ActaDefunsion->dniFallecido==$actaPersona->DNI))
                                <td>{{$actaPersona->Persona->Nombres}}</td>
                            @else
                                                               
                            @endif 
                        
                        
                        
                    </TR>
                    <tr>
                        <th scope="row" >Primer Apellido</th>
                       
                        @if ( ($actaGenerada->ActaDefunsion->dniFallecido==$actaPersona->DNI))
                            <td>{{$actaPersona->Persona->Apellido_Paterno}}</td>
                        @else
                                                        
                        @endif 
                    </tr>
                    <tr>
                        <th scope="row" >Segundo Apellido</th>
                     
                        @if ( ($actaGenerada->ActaDefunsion->dniFallecido==$actaPersona->DNI))
                            <td>{{$actaPersona->Persona->Apellido_Materno}}</td>
                        @else
                          
                        @endif 
                    </tr>
                    <tr>
                        <th scope="row" >Nacionalidad</th>
                      
                            @if ( ($actaGenerada->ActaDefunsion->dniFallecido==$actaPersona->DNI))
                                <td>{{$actaPersona->Persona->nacionalidad}}</td>
                            @else
                                
                            @endif 
                    </tr>
                    <tr>
                        <th scope="row" >Documento de Identidad</th>
                        <td>{{$actaGenerada->ActaDefunsion->dniFallecido}}</td>
                 
                    </tr>
                    <tr>
                        <th scope="row" >Edad</th>
                        <td>{{$actaGenerada->ActaDefunsion->edad}}</td>
                 
                    </tr>
                </TBody>
                
                <tfoot>
                    <tr>
                        {{-- <th scope="row" >Domicilio de la madre</th>
                        <td colspan="2"> {{$actaGenerada->actanacimiento->domicilio}}</td> --}}
                    </tr>
                </tfoot>
                

            </table>
            <BR></BR>
            <label for=""> <strong>FICHA DE REGISTRO: {{$actaGenerada->fecha_registro}}</strong>  </label> 
            <BR></BR>
            <label for=""> <strong>REGISTRADOR: {{$actaGenerada->nombreRegistradorCivil}} </strong> </label>
            <BR></BR>
            <label for=""><strong> DECLARANTE: {{$actaGenerada->ActaDefunsion->nombreDeclarante}}</strong> </label>
            <BR></BR>
            <label for=""><strong> OBSERVACIONES: {{$actaGenerada->observacion}}</strong> </label>
          
            <br>
        </div><br>
        <div style="text-align: center">
            <img src="images/firma.png" alt="firma" width="15%" style="margin: 0;padding: 0"><br>
            <label>___________________________</label><br>
            <label>Director general de RENIEC</label>
        </div>
        <div style="text-align: center">
            <img src="public{{$actaGenerada->ActaDefunsion->firma_declarante}}" alt="firma" width="15%" style="margin: 0;padding: 0"><br> 
            
            <label>___________________________</label><br>
            <label>Firma del Declarante</label>
        </div>
    </div>
</body>
</html>