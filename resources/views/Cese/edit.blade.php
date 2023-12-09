@extends('dashboard')ese

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh" >
            <h1 id="titulo" class="acta_title">Editar Cese</h1>
            <form method="POST" action="{{ route('Cese.update', $Cese->idCese) }}">
                @method('PUT')
                @csrf
                
         
                <div class="row justify-content-center">
                    <div class="col-2 form-group">
                        <label class="control-label">Codigo</label>
                        <input type="text" class="form-control" style="color: blue" value="{{$Cese->idCese}}" disabled>
                    </div>
                    <div class="col-5 form-group">
                        <label class="control-label">Observacion</label>
                            <textarea  type="text" class="form-control @error('observacion') is-invalid @enderror"
                                placeholder="Ingrese observacion"  name="observacion" >{{$Cese->observacion}}</textarea >
                        @error('observacion')
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
                                                    {{$Cese->idContrato=$item->idContrato?'selected':''}}
                                                    >{{$item->trabajador->DNI}}-{{ $item->trabajador->persona->Nombres}} {{ $item->trabajador->persona->Apellido_Paterno}} {{ $item->trabajador->persona->Apellido_Materno}}</option> 
                                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row justify-content-center">
                    <div class="col-4 form-group">
                        <label class="control-label">Registro</label>
                     
                        <input type="date" class="form-control" value="{{$Cese->fechaRegistro}}" id="fechaRegistro" 
                            name="fechaRegistro" >
                        @error('fechaRegistro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label">Documento de despido</label>
                        <input type="file" class="form-control @error('archivoCese') is-invalid @enderror"
                        placeholder="Ingrese requisito" id="archivoCese" name="archivoCese"
                        value="{{ old('archivoCese') }}" x-data="showImage()" @change="showPreview(event)" >
                    @error('archivoCese')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <iframe id="preview" src="{{$Cese->archivoCese}}"  class="object-cover h-32 mt-2 " height="400vh"  width="100%" ></iframe> </iframe>
                    </div>
                </div>       

                        
                <div class="boton_div">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                    </div>
                    <div>
                        <a href="{{ route('Cese.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
