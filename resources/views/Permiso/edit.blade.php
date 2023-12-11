@extends('dashboard')ese

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh" >
            <h1 id="titulo" class="acta_title">Editar Permiso</h1>
            <form method="POST" action="{{ route('Permiso.update', $Permiso->idPermiso) }}">
                @method('PUT')
                @csrf
                
         
                <div class="row justify-content-center">
                    <div class="col-2 form-group">
                        <label class="control-label">Codigo</label>
                        <input type="text" class="form-control" style="color: blue" value="{{$Permiso->idPermiso}}" disabled>
                    </div>
                    <div class="col-5 form-group">
                        <label class="control-label">Motivo</label>
                            <textarea  type="text" class="form-control @error('motivo') is-invalid @enderror"
                                placeholder="Ingrese motivo"  name="motivo" >{{$Permiso->motivo}}</textarea >
                        @error('motivo')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-3 form-group">
                        <label class="control-label">Trabajador</label>
                        <select name="idContrato" id="idContrato" class="form-control @error('idContrato') is-invalid @enderror"  >
                       
                            @foreach ($contratos as $item)
                                                <option value="{{$item->idContrato}}"
                                                    {{$Permiso->idContrato=$item->idContrato?'selected':''}}
                                                    >{{$item->trabajador->DNI}}-{{ $item->trabajador->persona->Nombres}} {{ $item->trabajador->persona->Apellido_Paterno}} {{ $item->trabajador->persona->Apellido_Materno}}</option> 
                                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-2 form-group">
                        <label class="control-label">Registro</label>
                     
                        <input type="date" class="form-control" value="{{$Permiso->fechaRegistro}}" id="fechaRegistro" 
                            name="fechaRegistro" >
                        @error('fechaRegistro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2 form-group">
                        <label class="control-label">Incio</label>
                     
                        <input type="date" class="form-control"  id="fecha_inicio" value="{{$Permiso->fecha_inicio}}"
                            name="fecha_inicio" >
                        @error('fecha_inicio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2 form-group">
                        <label class="control-label">Fin</label>
                     
                        <input type="date" class="form-control"  id="fecha_fin" value="{{$Permiso->fecha_fin}}"
                            name="fecha_fin" >
                        @error('fecha_fin')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2 form-group">
                        <label class="control-label">Estado</label>
                        <select name="estadoPermiso" id="estadoPermiso" class="form-control @error('estadoPermiso') is-invalid @enderror"  >
                            <option value="0" 
                            {{$Permiso->estadoPermiso=0?'selected':''}}
                            >Pendiente</option>
                            <option value="1"
                            {{$Permiso->estadoPermiso=1?'selected':''}}
                            >Aceptado</option>
                            <option value="2"
                            {{$Permiso->estadoPermiso=2?'selected':''}}
                            >Rechazado</option>
                         
                        </select>
                            @error('estadoPermiso')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    
                </div>  
                <div class="row justify-content-center"> 
                    <div class="col-4 form-group">
                        <label class="control-label">Tipo de permiso</label>
                        <select name="tipo_permiso" id="tipo_permiso" class="form-control @error('tipo_permiso') is-invalid @enderror"  >
                            <option value="0"
                            {{$Permiso->tipo_permiso=0?'selected':''}}
                            >Enfermedad</option>
                            <option value="1"
                            {{$Permiso->tipo_permiso=1?'selected':''}}
                            >Personal</option>
                        </select>
                            @error('tipo_permiso')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label">Documento del permiso</label>
                        <input type="file" class="form-control @error('archivoPermiso') is-invalid @enderror"
                        placeholder="Ingrese requisito" id="archivoPermiso" name="archivoPermiso"
                        value="{{ old('archivoPermiso') }}" x-data="showImage()" @change="showPreview(event)" >
                    @error('archivoPermiso')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <iframe id="preview" src="{{$Permiso->archivoPermiso}}"  class="object-cover h-32 mt-2 " height="400vh"  width="100%" ></iframe> </iframe>
                    </div> 
                </div>    

                        
                <div class="boton_div">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                    </div>
                    <div>
                        <a href="{{ route('Permiso.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
