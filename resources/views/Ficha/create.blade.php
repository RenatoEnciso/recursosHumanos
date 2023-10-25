@extends('dashboard')

@section('titulo', 'Registro FICHA')


@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
            <h1 id="titulo" class="acta_title">REGISTRO FICHA </h1>
            <form method="POST" action="{{ route('Ficha.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label class="control-label">Fecha de registro</label>
                        <input type="text" class="form-control" value="{{$fecha_actual}}" id="fecha_registro" 
                            name="fecha_registro" >
                    </div>

                    <div class="col-8 form-group">
                        <label class="control-label">Tipo de Ficha</label>
                        <select name="tipoFicha" id="" class="form-control">
                            @foreach ($tipoFichas as $item)
                                <option value="{{ $item->idtipo }}">{{ $item->nombre }}</option> 
                            @endforeach
                        </select>
                    </div>

                    <div class="col-8 form-group">
                        <label class="control-label">Certificado de NACIMIENTO /DEFUNCION / MATRIMONIO </label>
                        <input type="file" class="form-control @error('archivo_certificado') is-invalid @enderror"
                            placeholder="Ingrese certificado" id="archivo_certificado" name="archivo_certificado"
                            value="{{ old('archivo_certificado') }}" x-data="showImage()" @change="showPreview(event)" >
                        @error('archivo_certificado')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <iframe id="preview" class="object-cover h-32 mt-2 w-60" height="400vh" style="display: none"> </iframe>
                        <br>
                    </div>
                    <div class="boton_div">
                        <div class="col-8 form-group flex">
                            <div style="margin-right: 1vh">
                                <button class="btn btn-primary boton"><i class="fas fa-save"></i> ENVIAR</button>
                            </div>
                            
                            <div>
                                <a href="{{route('Ficha.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
