@extends('dashboard')

@section('titulo', 'Registro Oferta')


@section('contenido')
    <div class="container">
        {{-- <br><br><br><br><br> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

{{-- <h2>Formulario Dinámico</h2>

<form method="POST" action="{{ route('Oferta.store') }}" enctype="multipart/form-data">
    @csrf
    <div id="formulario">
        <label for="pregunta1">Pregunta 1:</label><br>
        <input type="text" id="pregunta1" name="preguntas[]"><br>
    </div>
    <button type="button" id="agregarPregunta">Agregar Pregunta</button>
    <input type="submit" value="Enviar">
</form> --}}
        <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
            <h1 id="titulo" class="acta_title">Registro Oferta </h1>
            <form method="POST" action="{{ route('Oferta.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">1 Datos Personales y CV</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">2 Educación y experiencia laboraal</button>
                        </li>
                
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
          
                    <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                       
                        <div class="row justify-content-center">
                            <div class="col-8 form-group">
                                <label class="control-label">Descripción</label>
                                    <textarea  type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                        placeholder="Ingrese descripcion"  name="descripcion" ></textarea >
                                @error('descripcion')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label class="control-label">Fecha de inicio</label>
                                <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                    name="fecha_inicio" >
                                @error('fecha_inicio')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Fecha de fin</label>
                                <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror"  
                                    name="fecha_fin" >
                                @error('fecha_fin')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 form-group">
                                <label class="control-label">Cargo</label>
                                <select name="idCargo" id="idCargo" class="form-control">
                                    @foreach ($cargos as $item)
                                        <option value="{{ $item->idCargo}}">{{ $item->descripcion }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 form-group">
                                <label class="control-label">Monto(S/.)</label>
                                <input type="text" class="form-control @error('monto') is-invalid @enderror"
                                    placeholder="Ingrese monto"  name="monto">
                                @error('monto')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-2 form-group">
                                <label class="control-label">Tipo</label>
                                <select name="convocatoria" id="convocatoria" class="form-control">
                                
                                        <option value="1">CAS</option> 
                                        <option value="2">Práctica</option> 
                                </select>
                            </div>
                            <div class="boton_div">
                                <div class="col-8 form-group flex">
                                    <div>
                                        <button onclick="document.getElementById('contact-tab').click();" type="button" role="tab"class="btn btn-primary boton">Siguiente</button>
                                    
                                    </div>
        
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                
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
                        <div class="row justify-content-center">

                            <div class="col-4 form-group">
                                <label class="control-label">Requisitos de postulante</label>
                                <input type="file" class="form-control @error('requisitos') is-invalid @enderror"
                                placeholder="Ingrese requisito" id="requisitos" name="requisitos"
                                value="{{ old('requisitos') }}" x-data="showImage()" @change="showPreview(event)">
                            @error('requisitos')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <iframe id="preview"   class="object-cover h-32 mt-2 " height="400vh" style="display: none" width="100%"></iframe> </iframe>
                            </div>
                            <div class="col-4 form-group">
                                <label class="control-label">Manual de postulante</label>
                                <input type="file" class="form-control @error('manualPostulante') is-invalid @enderror"
                                placeholder="Ingrese manual de postulante" id="manualPostulante" name="manualPostulante"
                                value="{{ old('manualPostulante') }}" x-data="showImage1()" @change="showPreview(event)">
                            @error('manualPostulante')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <iframe id="preview1"   class="object-cover h-32 mt-2 " height="400vh" style="display: none" width="100%"> </iframe>
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
                                    {{-- <a href="{{route('Oferta.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>  
        </div>
    </div>


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
        function showImage1() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview1");
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
        $('#DNIf').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        $("#idCargo").select2({
        dropdownAutoWidth : true
        });
        }
        setTimeout(mensaje,500);

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var i = 2;
$('#agregarPregunta').click(function() {
    var nuevaPregunta = '<label for="pregunta'+i+'">Pregunta '+i+':</label><br><input type="text" id="pregunta'+i+'" name="preguntas[]"><br>';
    $('#formulario').append(nuevaPregunta);
    i++;
});
</script>
        

@endsection
