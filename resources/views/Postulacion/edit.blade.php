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
                                            >{{ $item->Nombres }}</option> 
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
                                <iframe id="preview"   class="object-cover h-32 mt-2 w-60" height="400vh" style="display: none"> </iframe>
                                </div>
                            </div>
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
