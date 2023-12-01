@extends('dashboard')

@section('titulo', 'Registro Contrato')


@section('contenido')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
            
            <h1 id="titulo" class="acta_title">Registro Contrato</h1>
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31) ">
                    {{session('error')}}
                </div>
                @endif
            1 trabajador-2 horario 3-datos generales de contrato
            {{-- INCIIO --}}
            {{-- <form method="POST" action="{{ route('Contrato.store') }}" enctype="multipart/form-data">
                @csrf
                <label for="tipo">Tipo de evento:</label>
                <select id="tipo" name="tipo">
                    <option value="">--Selecciona un tipo--</option>
                    <option value="diario">Diario</option>
                    <option value="variable">Día variable</option>
                </select>
            
                <div id="diario" style="display: none;">
                    <label for="horaDiario">Hora:</label>
                    <input type="time" id="horaDiario" name="horaDiario">
                </div>
            
                <div id="variable" style="display: none;">
                    <div class="horasVariables">
                        <label for="dias1">Días:</label>
                        <select id="dias1" name="dias[]" multiple class="dias">
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="Miercoles">Miercoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sabado</option>
                            <option value="Domingo">Domingo</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
            
                        <label for="horas[]">Hora:</label>
                        <input type="time" id="horas[]" name="horas[]">
                    </div>
            
                    <button type="button" id="agregarHora">Agregar otra hora</button>
                </div>
            
                <input type="submit" value="Guardar">
            </form>
            
            <script>
            document.getElementById('tipo').addEventListener('change', function() {
                // Ocultar todos los conjuntos de campos
                document.getElementById('diario').style.display = 'none';
                document.getElementById('variable').style.display = 'none';
            
                // Mostrar el conjunto de campos correspondiente al tipo seleccionado
                if (this.value === 'diario') {
                    document.getElementById('diario').style.display = 'block';
                } else if (this.value === 'variable') {
                    document.getElementById('variable').style.display = 'block';
                }
            });
            
            document.getElementById('agregarHora').addEventListener('click', function() {
                // Crear un nuevo conjunto de campos
                var div = document.createElement('div');
                div.className = 'horasVariables';
            
                var labelDias = document.createElement('label');
                labelDias.textContent = 'Días:';
                div.appendChild(labelDias);
            
                var select = document.createElement('select');
                select.name = 'dias[]';
                select.multiple = true;
                select.className = 'dias';
                
                // Agregar las opciones que no han sido seleccionadas en otros selects
                var dias = ['lunes', 'martes',  "Miercoles","Jueves", "Viernes"  ,  "Sabado" ,  "Domingo"
                
            /* más días aquí */];
                var selectsExistentes = document.querySelectorAll('.dias');
                
                dias.forEach(function(dia) {
                    var seleccionado = Array.from(selectsExistentes).some(function(selectExistente) {
                        return Array.from(selectExistente.options).some(function(option) {
                            return option.value === dia && option.selected;
                        });
                    });
                    
                    if (!seleccionado) {
                        var option = document.createElement('option');
                        option.value = dia;
                        option.textContent = dia.charAt(0).toUpperCase() + dia.slice(1);  // Capitalizar el día
                        select.appendChild(option);
                    }
                    
                });
                
                div.appendChild(select);
            

                
                var labelHora = document.createElement('label');
                labelHora.textContent = 'Hora:';
                div.appendChild(labelHora);
            
                var input = document.createElement('input');
                input.type = 'time';
                input.name = 'horas[' + document.querySelectorAll('.horasVariables').length + ']';
                
                div.appendChild(input);
            
                // Agregar el nuevo conjunto de campos al DOM
                document.getElementById('variable').appendChild(div);
            });
            </script> --}}
            
            {{-- FIN --}}

            
            
            
            
            
            
{{-- fin             --}}



            
            
            
            <form method="POST" action="{{ route('Contrato.store') }}" enctype="multipart/form-data">
                @csrf
            <div class="row justify-content-center">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">1 Datos Trabajador</button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">2 Horario </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contrato-tab" data-bs-toggle="tab" data-bs-target="#contrato-tab-pane" type="button" role="tab" aria-controls="contrato-tab-pane" aria-selected="false">3 Detalles de contrato </button>
                    </li>
            
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
          
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row justify-content-center">
                                {{-- <div class="col-4 form-group">
                                    <label class="control-label">contrato</label>
                                    <input type="file" class="form-control @error('contrato') is-invalid @enderror"
                                        placeholder="Ingrese contrato"  name="contrato">
                                    @error('contrato')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                
                                {{-- <div class="col form-group">
                                    <label class="control-label">Trabajador</label>
                                    <select name="idTrabajador" id="idTrabajador" class="form-control" readonly >
                                        @foreach ($trabajadores as $item)
                                        <option value="{{ $item->idTrabajador}}"
                                           
                                            >{{ $item->idTrabajador}}</option> 
                                        @endforeach
                                  
                                    </select>
                                </div> --}}
                                <div class="col-6 form-group">
                                    <label class="control-label">Trabajador</label>
                                    <select name="idTrabajador" id="idTrabajador" class="form-control @error('idTrabajador') is-invalid @enderror"  >
                                        <option value="0">Nuevo Trabajador</option>
                                        {{-- <option value="1">2</option> --}}
                                        @foreach ($trabajadores as $item)
                                            <option value="{{ $item->DNI}}"
                                                {{$entrevista->postulacion->DNI==$item->DNI?'selected':''}}
                                                >{{ $item->DNI}}{{ $item->persona->nombres}} {{ $item->persona->apellidos_paterno}} {{ $item->persona->apellidos_materno}}</option> 
                                        @endforeach
                                    </select>
                                    @error('idTrabajador')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror

                                     <input type="text" class="form-control @error('idEntrevista') is-invalid @enderror" value="{{$entrevista->idEntrevista}}" id="idEntrevista" 
                                            name="idEntrevista" style="display: none;">
                                        @error('idEntrevista')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror


                                     <!-- Aquí está tu nuevo botón, que está oculto por defecto -->
                                        <button id="crearButton" style="display: none;">Crear</button>
                                </div>
                               
                                <div class="row justify-content-center" id="form-new-worker">
                                    <div class="col-3 form-group">
                                        <label class="control-label">Persona</label>
                                        {{-- <select name="DNI" id="DNI" class="form-control @error('DNI') is-invalid @enderror"  >
                                            @foreach ($personas as $item)
                                                <option value="{{ $item->DNI}}"
                                                    {{$item->DNI==$entrevista->Postulacion->DNI?'selected':''}}
                                                    >{{ $item->DNI}}</option> 
                                            @endforeach
                                        </select> --}}
                                        <input type="text" class="form-control @error('DNI') is-invalid @enderror" value="{{$entrevista->Postulacion->DNI}}" id="seguro" 
                                            name="DNI" readonly >
                                        @error('DNI')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                           
                                    
                                    </div>
                                    <div class="col-2 form-group">
                                        <label class="control-label">Fondo</label>
                                        <select name="ONP" id="ONP" class="form-control" >
                                        
                                            <option value="1">ONP</option> 
                                            <option value="0">AFP</option> 
                                       
                                            {{-- <option value="5">5</option> 
                                            <option >6</option>  --}}
                                        </select>
                                    </div>
                                    <div class="col-3 form-group">
                                        <label class="control-label">Seguro</label>
                                        <input type="text" class="form-control @error('seguro') is-invalid @enderror" value="" id="seguro" 
                                            name="seguro" >
                                        @error('seguro')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
    
                                    
                                    
                                    <div class="row justify-content-center">
                        
                        
                                   
                                        <div class="col-4 form-group">
                                            <label class="control-label">Direccion</label>
                                        
                                            <input type="text" class="form-control @error('direccion') is-invalid @enderror" value="" id="direccion" 
                                                name="direccion" >
                                            @error('direccion')
                                                <span class="invalid feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
        
                                        
                                        
                                        {{-- </div>
                                        <div class="row justify-content-center">--}}
                            
                            
                                        <div class="col-4 form-group">
                                            <label class="control-label">Email address</label>
                                            <input type="email" class="form-control @error('correoPersonal') is-invalid @enderror"   name="correoPersonal" id="correoPersonal" >
                                            @error('correoPersonal')
                                                <span class="invalid feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                        <div class="col-4 form-group">
                                            <label class="control-label">Teléfono</label>
                                        
                                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="" id="telefono" 
                                                name="telefono" >
                                            @error('telefono')
                                                <span class="invalid feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                           
                        </div>
                        {{-- <div class="col-4"> --}}
                            {{-- <div class="row justify-content-center">
                    
                    
                                <div class="col-6 form-group">
                                    <label class="control-label">Email address</label>
                                    <input type="email" class="form-control @error('correoPersonal') is-invalid @enderror" id="floatingInput"  name="correoPersonal" id="correoPersonal" >
                                    @error('correoPersonal')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                  </div>
            
                                <div class="col-6 form-group">
                                    <label class="control-label">Teléfono</label>
                                
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="" id="telefono" 
                                        name="telefono" >
                                    @error('telefono')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                                
                                
                            </div> --}}
                            {{-- <div class="col-12">
                                <label class="control-label">Archivo de Nacimiento</label>
                                <input type="file" class="form-control @error('archivo_nacimiento') is-invalid @enderror"
                                    placeholder="Ingrese Archivo" id="archivo_nacimiento" name="archivo_nacimiento"
                                    value="{{ old('archivo_nacimiento') }}" x-data="showImage()" @change="showPreview(event)">
                                @error('archivo_nacimiento')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                                <br>
                            </div> --}}
                            {{-- <div class="row justify-content-center">

                                <div class="col-12 form-group">
                                    <label class="control-label">contrato</label>
                                    <input type="file" class="form-control @error('contrato') is-invalid @enderror"
                                    placeholder="Ingrese contrato" id="contrato" name="contrato"
                                    value="{{ old('contrato') }}" x-data="showImage()" @change="showPreview(event)">
                                @error('contrato')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh" width="100%" style="display: none"> </iframe>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
                    </div>
                    <div class="boton_div">
                        <div class="col-8 form-group flex">
                            <div>
                                <button onclick="document.getElementById('contact-tab').click();" type="button" role="tab"class="btn btn-primary boton">Siguiente</button>
                            
                            </div>

                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label class="control-label">Horario</label>
                            <select name="idHorario[]" id="idHorario[]" class="form-control @error('idHorario[]') is-invalid @enderror"  multiple>
                                <option value="0">Nuevo Horario</option>
                             @php
                                 $dias=['Lunes', 'Martes',  "Miercoles","Jueves", "Viernes"  ,  "Sabado" ,  "Domingo"]
                             @endphp
                                @foreach ($horarios as $item)
                                    
                                    <option value="{{ $item->idHorario}}"
    
                                        {{-- {{$entrevista->postulacion->DNI==$item->DNI?'selected':''}} --}}
                                        >{{ $item->hora_inicio}}-{{ $item->hora_fin}}. {{ $dias[$item->dia-1]}}</option> 
                                @endforeach
                            </select>
                            @error('eventos.*.hora_inicio')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('eventos.*.hora_fin')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        @error('idTrabajador')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror

                         <input type="text" class="form-control @error('idEntrevista') is-invalid @enderror" value="{{$entrevista->idEntrevista}}" id="idEntrevista" 
                                name="idEntrevista" style="display: none;">
                            @error('idEntrevista')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror


                         <!-- Aquí está tu nuevo botón, que está oculto por defecto -->
                            <button id="crearButton" style="display: none;">Crear</button>
                    </div>
                    <div class="row justify-content-center"   >
                        <div class="col-6 form-group" id="New_horario" style="display: none;">
                            <label for="tipo" class="control-label">Tipo de evento:</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="">--Selecciona un tipo--</option>
                                <option value="diario">Diario</option>
                                <option value="variable">Día variable</option>
                            </select>
                        
                          
                        </div> 
                        
                       
                    </div> 
                    <div class="row justify-content-center" id="diario" style="display: none;"> 
                        
                            <div >
                                <label for="horaDiario" class="control-label">Hora:</label>
                                <input type="time" id="horaDiario" name="horaDiario">
                            </div>
                    </div>
                    <div id="variable" style="display: none;" >
                       
                        <div class="row justify-content-center horasVariables"  >
                            <div class="col-3 form-group">
                              
                                    <label for="dias1" class="control-label">Días:</label>
                                    <select id="dias1" name="eventos[0][dias][]" multiple  class="form-control dias">
                                        <option value="1" selected>Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miercoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sabado</option>
                                        <option value="7">Domingo</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                        
                              
                            </div>
                            <div class="col-3 form-group">
                                <label for="horaVariable1" class="control-label">Hora inicio:</label>
                                <input type="time" id="horaVariable1" name="eventos[0][hora_inicio]" class="form-control" >

                                <label for="horaVariable2" class="control-label">Hora fin:</label>
                                <input type="time" id="horaVariable2" name="eventos[0][hora_fin]" class="form-control" >
                               
                            </div>   
                            <div class="col-3 form-group">
                                <label class="control-label">Lugar</label>
                            
                                <input type="text" class="form-control @error('eventos[0][lugar]') is-invalid @enderror"  id="eventos[0][lugar]" 
                                    name="eventos[0][lugar]" >
                                @error('eventos[0][lugar]')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              
                            </div> 
                             
                        </div>
                    </div>
                   
                    <div class="text-center" id="botonHora" style="display: none">
                        <button type="button" id="agregarHora" class="btn btn-primary boton">Agregar otra hora</button>
                    </div>  
              
                    <div class="boton_div">
                        <div class="col-8 form-group flex">
                            <div>
                                <button onclick="document.getElementById('contrato-tab').click();" type="button" role="tab"class="btn btn-primary boton">Siguiente</button>
                            
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contrato-tab-pane" role="tabpanel" aria-labelledby="contrato-tab" tabindex="0">
                    <div class="row justify-content-center">
                        {{-- $Contrato->descripcion=$request->descripcion;
                        $Contrato->fecha_inicio=$request->fecha_inicio;
                        $Contrato->fecha_fin=$request->fecha_fin;
                        $Contrato->contrato=$url; --}}
                        <div class="col-5 form-group">
                            <label class="control-label">Descripción</label>
                                <textarea  type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                    placeholder="Ingrese descripcion"  name="descripcion" ></textarea >
                            @error('descripcion')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-3 form-group">
                            <label class="control-label">Dias Vacaciones</label>
                        
                            <input type="number" class="form-control" value="" id="diasVacaciones" 
                                name="diasVacaciones" >
                            @error('diasVacaciones')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>   
                    <div class="row justify-content-center">
                        <div class="col-4 form-group">
                            <label class="control-label">Inicio</label>
                        
                            <input type="date" class="form-control" value="" id="fecha_inicio" 
                                name="fecha_inicio" >
                            @error('fecha_inicio')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-4 form-group">
                            <label class="control-label">Fin</label>
                        
                            <input type="date" class="form-control" value="" id="fecha_fin" 
                                name="fecha_fin" >
                            @error('fecha_fin')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  
                    <div class="row justify-content-center">

                                <div class="col-8 form-group">
                                    <label class="control-label">Contrato</label>
                                    <input type="file" class="form-control @error('contrato') is-invalid @enderror"
                                    placeholder="Ingrese contrato" id="contrato" name="contrato"
                                    value="{{ old('contrato') }}" x-data="showImage()" @change="showPreview(event)">
                                @error('contrato')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh" width="100%" style="display: none"> </iframe>
                                </div>
                            </div>
                  
              
              
                    <div class="boton_div">
                        <div class="col-8 form-group flex">
                            <div>
                                <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                            </div>
                            <div></div>
                            <div>
                                <a href="/Oferta" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                                {{-- <a href="{{route('Entrevista.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            </form>
        </div>
    </div>
    <script>
        
        // Primero, obtén una referencia a ambos selects
        // var selectHorario = document.getElementById("idHorario[]");
        // var selectDias = document.getElementById("dias1");

        // // Añade un evento de escucha al primer select
        // selectHorario.addEventListener("change", function() {
        //     // Cuando el valor del primer select cambia, recorre todas las opciones del segundo select
        //     for (var i = 0; i < selectDias.options.length; i++) {
        //         // Si el valor de la opción del segundo select está en los valores seleccionados del primer select, oculta la opción
        //         if (Array.from(this.selectedOptions).map(opt => opt.value).includes(selectDias.options[i].value)) {
        //             selectDias.options[i].style.display = "none";
        //         } else {
        //             // Si no, muestra la opción
        //             selectDias.options[i].style.display = "block";
        //         }
        //     }
        // });
// Primero, obtén una referencia al primer select
var selectHorario = document.getElementById("idHorario[]");

// Añade un evento de escucha al primer select
selectHorario.addEventListener("change", function() {
    // Cuando el valor del primer select cambia, recorre todos los selects en la página
    if (this.value === '0') {
        document.getElementById('New_horario').style.display = "block";

    } else  {
                document.getElementById('New_horario').style.display = "none";
                document.getElementById('diario').style.display = 'none';
            document.getElementById('variable').style.display = 'none';
            document.getElementById('botonHora').style.display = 'none';
                
     }


    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        // Si el select actual no es el primer select, entonces actualiza sus opciones
        if (selects[i] !== selectHorario) {
            // Recorre todas las opciones del select actual
            for (var j = 0; j < selects[i].options.length; j++) {
                // Si el valor de la opción del select actual está en los valores seleccionados del primer select, oculta la opción
                if (Array.from(selectHorario.selectedOptions).map(opt => opt.value).includes(selects[i].options[j].value)) {
                    selects[i].options[j].style.display = "none";
                    // selects[i].options[(j+1].style.display = "none";
                    selects[i].options[j].removeAttribute("selected");
                    // selects[i].options[j + 1].selected = true;
                } else {
                    // Si no, muestra la opción
                    selects[i].options[j].style.display = "block";
                }
            }
        }
    }
});



    </script>
    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            // Ocultar todos los conjuntos de campos
            document.getElementById('diario').style.display = 'none';
            document.getElementById('variable').style.display = 'none';
            document.getElementById('botonHora').style.display = 'none';
            
        
            // Mostrar el conjunto de campos correspondiente al tipo seleccionado
            if (this.value === 'diario') {
                document.getElementById('diario').style.display = '';
            } else if (this.value === 'variable') {
                document.getElementById('variable').style.display = '';
                document.getElementById('botonHora').style.display = '';
            }
        });
        
        document.getElementById('agregarHora').addEventListener('click', function() {
            // Crear un nuevo conjunto de campos
            


            var divP = document.createElement('div');
            divP.className = 'row justify-content-center';
            

            var div1 = document.createElement('div');
            div1.className = 'col-3 form-group';

            var div2 = document.createElement('div');
            div2.className = 'col-3 form-group';

            var div3 = document.createElement('div');
            div3.className = 'col-3 form-group';
 
        
            var labelDias = document.createElement('label');
            labelDias.textContent = 'Días:';


            div1.appendChild(labelDias);
        
            var select = document.createElement('select');
            select.name = 'eventos[' + document.querySelectorAll('.horasVariables').length + '][dias][]';
            select.multiple = true;
            select.className = 'form-control dias';
            
            // Agregar las opciones que no han sido seleccionadas en otros selects


            
            var dias = ['lunes', 'martes',  "miercoles","jueves", "viernes"  ,  "sabado" ,  "domingo" /* más días aquí */];

            var selectsExistentes = document.querySelectorAll('.dias');

            dias.forEach(function(dia, index) {
                var seleccionado = Array.from(selectsExistentes).some(function(selectExistente) {
                    return Array.from(selectExistente.options).some(function(option) {
                        return option.value === String(index+1) && option.selected;
                    });
                });

                if (!seleccionado) {
                    var option = document.createElement('option');
                    option.value = index+1;  // Usar el índice como valor
                    option.textContent = dia.charAt(0).toUpperCase() + dia.slice(1);  // Capitalizar el día
                    select.appendChild(option);
                }
            });

            
          
            div1.appendChild(select);
        
            var labelHora = document.createElement('label');
            labelHora.textContent = 'Hora inicio:';
            div2.appendChild(labelHora);
        
            var input = document.createElement('input');
            input.type = 'time';
            input.name = 'eventos[' + document.querySelectorAll('.horasVariables').length + '][hora_inicio]';
            input.className = 'form-control';
            
            div2.appendChild(input);


            var labelHora = document.createElement('label');
            labelHora.textContent = 'Hora fin:';
            div2.appendChild(labelHora);
        
            var input = document.createElement('input');
            input.type = 'time';
            input.name = 'eventos[' + document.querySelectorAll('.horasVariables').length + '][hora_fin]';
            input.className = 'form-control';
            
            div2.appendChild(input);



            var labelLugar= document.createElement('label');
            labelLugar.textContent = 'Lugar:';
            div3.appendChild(labelLugar);
        
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'eventos[' + document.querySelectorAll('.horasVariables').length +  '][lugar]';
            input.className = 'form-control';
            
            div3.appendChild(input);

            divP.appendChild(div1)
            divP.appendChild(div2)
            divP.appendChild(div3)
        

            // Agregar el nuevo conjunto de campos al DOM
            document.getElementById('variable').appendChild(divP);




            var selectHorario = document.getElementById("idHorario[]");

// Añade un evento de escucha al primer select

    // Cuando el valor del primer select cambia, recorre todos los selects en la página
    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        // Si el select actual no es el primer select, entonces actualiza sus opciones
        if (selects[i] !== selectHorario) {
            // Recorre todas las opciones del select actual
            for (var j = 0; j < selects[i].options.length; j++) {
                // Si el valor de la opción del select actual está en los valores seleccionados del primer select, oculta la opción
                if (Array.from(selectHorario.selectedOptions).map(opt => opt.value).includes(selects[i].options[j].value)) {
                    selects[i].options[j].style.display = "none";
                    selects[i].options[j].removeAttribute("selected");
                } else {
                    // Si no, muestra la opción
                    selects[i].options[j].style.display = "block";
                }
            }
        }
    }

        });
        </script>
    <script>
        // Escucha el evento 'change' en tu elemento select
        document.getElementById('idTrabajador').addEventListener('change', function() {
            // Si se seleccionó 'Nuevo Trabajador', muestra el botón. Si no, ocúltalo.
            if (this.value == '0') {
                document.getElementById('form-new-worker').style.display = '';
                
                // document.getElementById('crearButton').style.display = 'block';
                // document.getElementById('crearButton').style.display = 'none';
                // document.getElementById('seguro').style.display = 'block';
                // document.getElementById('ONP').style.display = 'block';
                // document.getElementById('DNI').style.display = 'block';
                // document.getElementById('correoPersonal').style.display = 'block';
                // document.getElementById('telefono').style.display = 'block';
                // document.getElementById('direccion').style.display = 'block';
                // document.getElementById('seguro').value="";
                // document.getElementById('ONP').value="";
                // document.getElementById('DNI').value="";
                // document.getElementById('telefono').value="";
                // document.getElementById('telefono').value="";
                // document.getElementById('direccion').value="";
            } else {
                // document.getElementById('crearButton').style.display = 'none';
                document.getElementById('form-new-worker').style.display = 'none';
                // document.getElementById('seguro').style.display = 'none';
                // document.getElementById('ONP').style.display = 'none';
                // document.getElementById('DNI').style.display = 'none';
                // document.getElementById('correoPersonal').style.display = 'none';
                // document.getElementById('telefono').style.display = 'none';
                // document.getElementById('direccion').style.display = 'none';
            }
        });
        </script>
    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
    <script>
        function mensaje() {
        $('#DNI').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        }
        setTimeout(mensaje,100);
    </script>
   <script>
    $(document).ready(function() {
        $("#crearButton").click(function() {
            var errores = false;

            // Itera sobre cada evento y verifica la relación entre hora_inicio y hora_fin
            $("input[name^='eventos']").each(function(index, element) {
                var horaInicioStr = $(element).parent().find("input[name$='[hora_inicio]']").val();
                var horaFinStr = $(element).parent().find("input[name$='[hora_fin]']").val();

                if (horaInicioStr && horaFinStr) {
                    var horaInicio = new Date("1970-01-01T" + horaInicioStr);
                    var horaFin = new Date("1970-01-01T" + horaFinStr);

                    // Compara las horas de inicio y fin
                    if (horaInicio >= horaFin) {
                        alert("La hora de fin debe ser mayor que la hora de inicio para cada evento.");
                        errores = true;
                        return false; // Detener la iteración si hay un error
                    }
                }
            });

            // Si no hay errores, envía el formulario
            if (!errores) {
                $("form").submit();
            }
        });

        // Otro código que puedas tener...
    });
</script>

   

@endsection
