@extends('dashboard')

@section('titulo', 'Registro Permiso')


@section('contenido')
    <div class="container ">
        {{-- <br><br><br><br><br> --}}
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh" >
            <h1 id="titulo" class="acta_title">Registro Permiso </h1>
          
            <form method="POST" action="{{ route('Permiso.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-5 form-group">
                        <label class="control-label">Motivo</label>
                            <textarea  type="text" class="form-control @error('motivo') is-invalid @enderror"
                                placeholder="Ingrese motivo"  name="motivo" ></textarea >
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
                                                    
                                                    >{{$item->trabajador->DNI}}-{{ $item->trabajador->persona->Nombres}} {{ $item->trabajador->persona->Apellido_Paterno}} {{ $item->trabajador->persona->Apellido_Materno}}</option> 
                                            @endforeach
                        </select>
                            @error('idTrabajador')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                                       
                    

                </div>
                <div class="row justify-content-center">
                    <div class="col-2 form-group">
                        <label class="control-label">Registro</label>
                     
                        <input type="date" class="form-control"  id="fechaRegistro" 
                            name="fechaRegistro" >
                        @error('fechaRegistro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2 form-group">
                        <label class="control-label">Incio</label>
                     
                        <input type="date" class="form-control"  id="fecha_inicio" 
                            name="fecha_inicio" >
                        @error('fecha_inicio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-2 form-group">
                        <label class="control-label">Fin</label>
                     
                        <input type="date" class="form-control"  id="fecha_fin" 
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
                            <option value="0">Pendiente</option>
                            <option value="1">Aceptado</option>
                            <option value="2">Rechazado</option>
                         
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
                            <option value="0">Enfermedad</option>
                            <option value="1">Personal</option>
                        </select>
                            @error('tipo_permiso')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label">Documento de despido</label>
                        <input type="file" class="form-control @error('archivoPermiso') is-invalid @enderror"
                        placeholder="Ingrese requisito" id="archivoPermiso" name="archivoPermiso"
                        value="{{ old('archivoPermiso') }}" x-data="showImage()" @change="showPreview(event)" >
                    @error('archivoPermiso')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <iframe id="preview"  class="object-cover h-32 mt-2 " height="400vh"  width="100%" style="display: none"></iframe> </iframe>
                    </div>
                   
                </div> 
            {{-- </div>   --}}
                <div class="boton_div">
                    <div class="col-8 form-group flex">
                        <div>
                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                        </div>
                        <div></div>
                        <div>
                            <a href="{{route('Cese.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> 
                            
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
