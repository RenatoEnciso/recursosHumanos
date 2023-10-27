@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
            <h1 id="titulo" class="acta_title">Editar postulacion</h1>
            <form method="POST" action="{{ route('Postulacion.update', $Postulacion->idPostulacion) }}">
                @method('PUT')
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
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <div class="col form-group">
                                        <label class="control-label">Codigo</label>
                                        <input type="text" class="form-control" style="color: blue" value="{{ $Postulacion->idPostulacion }}" disabled>
                                    </div>
                                    <div class="col form-group">
                                        <label class="control-label">Fecha</label>
                                        <input type="date" class="form-control" value="" id="fecha" 
                                            name="fecha" value="{{$Postulacion->fecha}}">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col form-group">
                                        <label class="control-label">Oferta</label>
                                        <select name="idOferta" id="idOferta" class="form-control">
                                            @foreach ($ofertas as $item)
                                                <option value="{{ $item->idOferta}}"
                                                    {{$Postulacion->idOferta==$item->idOferta?'selected':''}}
                                                    >{{ $item->idOferta }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                
                                    <div class="col form-group">
                                        <label class="control-label">Persona</label>
                                        <select name="DNI" id="DNI" class="form-control">
                                            @foreach ($personas as $item)
                                                <option value="{{ $item->DNI}}"
                                                    {{$Postulacion->DNI==$item->DNI?'selected':''}}
                                                    >{{ $item->DNI }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                </div>   
                            </div>  
                            <div class="col-6">
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
            
                                        <div class="col-8 form-group">
                                            <label class="control-label">Curriculum</label>
                                            <input type="file" class="form-control @error('curriculum') is-invalid @enderror"
                                            placeholder="Ingrese curriculum" id="curriculum" name="curriculum"
                                            value="{{ old('curriculum') }}" x-data="showImage()" @change="showPreview(event)">
                                        @error('curriculum')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh" width="100%" src="{{$Postulacion->curriculum}}"> </iframe>
                                        </div>
                                    </div>
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
                                <div class="row justify-content-center">
                
                                    <div class="col-4 form-group">
                                        <label class="control-label">Titulo</label>
                                    
                                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" value="{{$Postulacion->titulo}}" id="tituloo" 
                                            name="titulo" >
                                        @error('titulo')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  
            
                                    </div>
                                    <div class="col-4 form-group">
                                        <label class="control-label">Pais</label>
                                    
                                        <input type="text" class="form-control @error('institucion') is-invalid @enderror" value="{{$Postulacion->pais}}" id="pais" 
                                            name="pais" >
                                        @error('pais')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>   
                                <div class="row justify-content-center">
                                    <div class="col-4 form-group">
                                        <label class="control-label">Institución</label>
                                    
                                        <input type="text" class="form-control @error('institucion') is-invalid @enderror" value="{{$Postulacion->institucion}}" id="institucion" 
                                            name="institucion" >
                                        @error('institucion')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-4 form-group">
                                        <label class="control-label">Area de estudio</label>
                                    
                                        <input type="text" class="form-control @error('areaEstudio') is-invalid @enderror" value="{{$Postulacion->areaEstudio}}" id="areaEstudio" 
                                            name="areaEstudio" >
                                        @error('areaEstudio')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>  
                                <div class="row justify-content-center"> 
                                    <div class="col-4 form-group">
                                        <label class="control-label">Nivel de estudio</label>
                                    
                                        <input type="text" class="form-control @error('nivelEstudio') is-invalid @enderror" value="{{$Postulacion->nivelEstudio}}" id="nivelEstudio" 
                                            name="nivelEstudio" >
                                            @error('nivelEstudio')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-4 form-group">
                                        <label class="control-label">Estado de estudio</label>
                                    
                                        <input type="text" class="form-control @error('estadoEstudio') is-invalid @enderror" value="{{$Postulacion->estadoEstudio}}" id="estadoEstudio" 
                                            name="estadoEstudio" >
                                        @error('estadoEstudio')
                                            <span class="invalid feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                        
                                <div class="boton_div">
                                    <div class="col-8 form-group flex">
                                        <div>
                                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                                        </div>
                                        <div>
                                            <a href="{{ route('Postulacion.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
        }
        setTimeout(mensaje,500);
    </script>
@endsection
