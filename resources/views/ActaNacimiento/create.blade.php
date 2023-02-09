@extends('dashboard')

@section('titulo', 'Registro de acta de nacimiento')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">REGISTRO DE ACTA DE NACIMIENTO</h1>
        <form method="POST" action="{{ route('ActaNacimiento.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div style="display: flex">
                        <div class="col col-6">
                            <label class="control-label">Numero de libro</label>
                            <select name="nroLibro" id="idLibro"
                                class="form-control @error('libro') is-invalid @enderror">
                                @foreach ($libros as $item)
                                    <option value="{{ $item->idLibro }}">Libro {{ $item->nroLibro }}</option>
                                @endforeach
                            </select>
                            @error('libro')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col col-6">
                            <label class="control-label">Numero de Folio</label>
                            <select name="nroFolio" id="idFolio"
                                class="form-control @error('folio') is-invalid @enderror">
                                @foreach ($folios as $item)
                                    <option value="{{ $item->idFolio }}">Folio {{ $item->nroFolio }}</option>
                                @endforeach
                            </select>
                            @error('folio')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Observación</label>
                        <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                            placeholder="Ingrese Observación" id="observacion" name="observacion">
                        @error('observacion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                            id="fecha_nacimiento" name="fecha_nacimiento">
                        @error('fecha_nacimiento')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Lugar de Nacimiento</label>
                        <input type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror"
                            placeholder="Ingrese lugar de nacimiento" id="lugar_nacimiento" name="lugar_nacimiento">
                        @error('lugar_nacimiento')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="persona">
                        <div class="form-group">
                            <label class="control-label">N° DNI</label>
                            <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                placeholder="Ingrese DNI"  name="dni">
                            @error('dni')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Apellido Paterno</label>
                            <input type="text" class="form-control @error('apellido1') is-invalid @enderror" 
                                placeholder="Ingrese Apellido paterno"  name="Apellido1">
                            @error('apellido2')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Apellido Materno</label>
                            <input type="text" class="form-control @error('apellido2') is-invalid @enderror" 
                                placeholder="Ingrese Apellido Materno" name="Apellido2">
                            @error('apellido2')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label class="control-label">Nombres Completos</label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                placeholder="Ingrese nombres" name="nombres">
                            @error('nombres')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label class="genero_title control-label">Género:</label><br>
                            <div class="form-check genero_caja">
                                <input checked class="form-check-input @error('sexo') is-invalid @enderror" type="radio" 
                                        name="sexo" id="idMasculino" value="M"  >
                                <label class="form-check-label" for="idMasculino"> &nbsp;Masculino </label>
                            </div>
                            <div class="form-check genero_caja">
                                <input class="form-check-input  @error('sexo') is-invalid @enderror" type="radio" 
                                        name="sexo" id="idFemenino" value="F" >
                                <label class="form-check-label" for="idFemenino"> &nbsp;Femenino</label>
                            </div>
                            @error('sexo')
                                <div class="invalid-feedback">
                                    <span>{{$message}}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-12">
                        <label class="control-label">Archivo de Nacimiento</label>
                        <input type="file" class="form-control @error('archivo_nacimiento') is-invalid @enderror"
                            placeholder="Ingrese Archivo" id="archivo_nacimiento" name="archivo_nacimiento"
                            value="{{ old('archivo_nacimiento') }}" x-data="showImage()" @change="showPreview(event)">
                        @error('archivo_nacimiento')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <iframe id="preview" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                        <br>
                    </div>
                </div>
                
               
                

            </div>
            <div class="boton_div">
                <div>
                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                </div>
                <div>
                    <a href="{{ route('ActaNacimiento.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                </div>
            </div>
        </form>
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
    </script>
    <script>
        function mensaje() {
        $('#DNI').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        }
        setTimeout(mensaje,100);
    </script>
@endsection
