@extends('dashboard')

@section('titulo', 'Registro de acta de nacimiento')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
            <h1 id="titulo" class="acta_title">REGISTRO DE ACTA DE NACIMIENTO</h1>
            <form method="POST" action="{{ route('ActaNacimiento.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">        
                        <div class="col-8 form-group">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <h1  class="text-center"> Datos del recien Nacido</h1> 
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col-auto">
                                            <label class="control-label">Codigo</label>
                                            <input type="text" class="form-control @error('idacta') is-invalid @enderror"
                                            value="{{$id}}"  id="idacta" name="idacta">
                                            </div>
                                        </div>
                                    <div class="row form-group">
                                        <div class="col-auto">
                                            <label class="control-label">Observación</label>
                                            <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                                                placeholder="Ingrese Observación" id="observacion" name="observacion">
                                            @error('observacion')
                                                <span class="invalid feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                
                                        <div class="col-auto">
                                            <label class="control-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                                id="fecha_nacimiento" name="fecha_nacimiento">
                                            @error('fecha_nacimiento')
                                                <span class="invalid feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            
                        </div>

                        <div class="col-8 form-group">
                            <div class="col-auto">
                                <label class="control-label">Lugar de Nacimiento</label>
                                <input type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror"
                                    placeholder="Ingrese lugar de nacimiento" id="lugar_nacimiento" name="lugar_nacimiento">
                                @error('lugar_nacimiento')
                                    <span class="invalid feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="persona col-8 form-group">
                            
                            <div class="form-group" >
                                <div class="row">
                                    <div class="col-auto">
                                        <label class="control-label">Localidad</label>
                                        <input type="text" class="form-control @error('localidad') is-invalid @enderror" 
                                            placeholder="Ingrese Localidad del nacido"  name="localidad">
                                        @error('localidad')
                                        <span class="invalid feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                    <div class="col-auto">
                                        <label class="control-label">Nombres</label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                    placeholder="Ingrese nombres" name="nombres">
                                @error('nombres')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                    </div> 
                                                                                
                                </div>
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
                    
                        <div class="col-8 form-group" >
                            <div class="row form-group">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <h1  class="text-center"> Datos del padre</h1>
                                </div>
                                <div class="persona col-12 d-flex justify-content-center">
                                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-auto">
                                                <label class="control-label">N° DNI:</label>
                                                

                                                <select class="form-control" name="dniP" aria-label="Default select example" id="dniP">
                                                    @foreach ($personas as $p )
                                                    @if ($p->sexo=='M' && $p->estado==1)
                                                    <option value="{{$p->DNI}}">{{$p->Nombres}} {{$p->Apellido_Paterno}},DNI:{{$p->DNI}}</option>  
                                                    @endif
                                                    
                                                    @endforeach                                              

                                                </select>
                                            </div>
                
                                            
                                        
                                        </div>
                                    </div>                             
                            
                                
                                </div>
                            </div>
                        </div>

                        <div class="col-8 form-group" >
                            <div class="row form-group">
                                <div class="col-sm-12 d-flex justify-content-center">
                                    <h1  class="text-center"> Datos de la madre</h1>
                                </div>
                                <div class="persona col-12 d-flex justify-content-center">
                                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-auto">
                                                <label class="control-label">N° DNI:</label>

                                                <select class="form-control" name="dniM"  aria-label="Default select example" id="dniM">
                                                    @foreach ($personas as $p )
                                                    @if ($p->sexo=='F' && $p->estado==1 )
                                                    <option value="{{$p->DNI}}">{{$p->Nombres}} {{$p->Apellido_Paterno}},DNI:{{$p->DNI}}</option>
                                                    @else
                                                        
                                                    @endif
                                                    
                                                    @endforeach                                              

                                                </select>
                                            </div>
                
                                        
                                        
                                        </div>
                                    </div>                       
                                
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-8 form-group">
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
                                <div class="row col-12 d-flex justify-content-center">
                                    <iframe id="preview"  src="{{asset($ficha->ruta_certificado)}}" class="object-cover h-32 mt-2 w-60" height="400vh" style="display: none"> </iframe>
                                </div>
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
        $('#dniP').select2();
        $('#dniM').select2();
        }
        setTimeout(mensaje,500);
    </script>
@endsection
