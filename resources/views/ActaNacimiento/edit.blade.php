@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">EDITAR ACTA DE NACIMIENTO</h1>
    <form method="POST" action="{{route("ActaNacimiento.update",$actaNacimiento->idActaPersona)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">CODIGO</label>
            <input type="text" style="color: blue"  class="form-control" value="{{$actaNacimiento->idActaPersona}}" disabled >
        </div>
    
        <div class="row">
            <div class="col-8">
                <div style="display: flex">
                    <div class="col col-6">
                        <label class="control-label">Numero de libro</label>
                        <select name="nroLibro" id="idLibro" class="form-control @error('libro') is-invalid @enderror">
                            @foreach($libros as $item)
                                <option value="{{$item['idLibro'] }}" {{$item->idLibro==$acta->idLibro?'selected':''}}> Libro
                                    {{$item['nroLibro'] }}</option>
                            @endforeach
                        </select>
                        @error('libro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col col-6">
                        <label class="control-label">Numero de Folio</label>
                        <select name="nroFolio" id="idFolio" class="form-control @error('folio') is-invalid @enderror">
                            @foreach($folios as $item)
                                <option value="{{$item['idFolio'] }}" {{$item->idFolio==$acta->idFolio?'selected':''}}  > Folio 
                                {{$item['nroFolio'] }}</option>
                            @endforeach
                        </select>
                        @error('folio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 form-group">
                    <label class="control-label">Observación</label>
                    <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                        value="{{$acta->observacion}}" id="observacion" name="observacion">
                    @error('observacion')
                    <span class="invalid feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-12 form-group">
                    <label class="control-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento"
                        name="fecha_nacimiento" value="{{$acta->fecha_Acta}}">
                    @error('fecha_nacimiento')
                    <span class="invalid feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12 form-group">
                    <label class="control-label">Lugar de Nacimiento</label>
                    <input type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror"
                            value="{{$acta->lugar_Acta}}" id="lugar_nacimiento" name="lugar_nacimiento">
                    @error('lugar_nacimiento')
                    <span class="invalid feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="persona">
                    <div class="form-group">
                        <label class="control-label">N° DNI</label>
                        <input type="text" name="dni" style="color: blue"  class="form-control @error('dni') is-invalid @enderror"
                            placeholder="Ingrese DNI" value="{{$actaNacimiento->persona->DNI}}" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellido Paterno</label>
                        <input type="text" class="form-control @error('apellido1') is-invalid @enderror" 
                            placeholder="Ingrese Apellido paterno"  value="{{$actaNacimiento->persona->Apellido_Paterno}}" name="Apellido1">
                        @error('apellido1')
                        <span class="invalid feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label class="control-label">Apellido Materno</label>
                        <input type="text" class="form-control @error('apellido2') is-invalid @enderror" 
                            placeholder="Ingrese Apellido Materno" value="{{$actaNacimiento->persona->Apellido_Materno}}" name="Apellido2">
                        @error('apellido2')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label class="control-label">Nombres Completos</label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                            value="{{$actaNacimiento->persona->Nombres}}" name="nombres">
                        @error('nombres')
                        <span class="invalid feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label class="genero_title control-label">Género:</label>
                    @if($actaNacimiento->persona->sexo=='M')
                        <div class="form-check genero_caja">
                            <input checked class="form-check-input @error('sexo') is-invalid @enderror" type="radio" 
                                    name="sexo" id="idMasculino" value="M">
                            <label class="form-check-label" for="idMasculino"> Masculino </label>
                        </div>
                        <div class="form-check genero_caja">
                            <input class="form-check-input  @error('sexo') is-invalid @enderror" type="radio" 
                                    name="sexo" id="idFemenino" value="F">
                            <label class="form-check-label" for="idFemenino"> Femenino</label>
                        </div>
                    
                    @else
                        <div class="form-check genero_caja">
                            <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" 
                                    name="sexo" id="idMasculino" value="M">
                            <label class="form-check-label" for="idMasculino"> Masculino </label>
                        </div>
                        <div class="form-check genero_caja">
                            <input checked class="form-check-input  @error('sexo') is-invalid @enderror" type="radio" 
                                    name="sexo" id="idFemenino" value="F">
                            <label class="form-check-label" for="idFemenino"> Femenino</label>
                        </div>
            
                        @error('sexo')
                            <div class="invalid-feedback">
                                <span>{{$message}}</span>
                            </div>
                        @enderror
                    @endif
                    </div>
                </div>
            </div>
            
            <div class="col-4">
                <div class="col-12">
                    <label class="control-label">Archivo de Nacimiento</label>
                    <input type="file" class="form-control @error('archivo_nacimiento') is-invalid @enderror"
                    placeholder="Ingrese Archivo" id="archivo_nacimiento" name="archivo_nacimiento"
                    value="{{ $acta->archivo }}" x-data="showImage()" @change="showPreview(event)">
                    <iframe src="{{$acta->archivo}}" id="preview" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                    @error('archivo_nacimiento')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
{{-- 
            <div class="col-12 form-group">
                <label class="control-label">Persona</label>
                <select name="dniPersona" id="DNI" class="form-control @error('persona') is-invalid @enderror">
                    @foreach ($personas as $item)
                        <option value="{{$item['DNI'] }}" {{$item->DNI==$actaNacimiento->DNI?'selected':''}}  >
                            {{$item['Nombres'] }}</option>
                    @endforeach
                </select>
                @error('persona')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div> --}}

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
    setTimeout(mensaje,500);
</script>
@endsection
