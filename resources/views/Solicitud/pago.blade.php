@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
        <h1 id="titulo"  class="row justify-content-center">REGISTRO DE PAGO</h1>
        <form method="POST" action="{{ route('Solicitud.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-8 form-group">
                    <label class="control-label" for="entidadBancaria">Entidad Financiera: </label>
                    <select name="entidadBancaria" id="entidadBancaria">
                        <option value="bcp">Banco de Crédito del Perú (BCP)</option>
                        <option value="interbank">Interbank</option>
                        <option value="scotiabank">Scotiabank</option>
                        <option value="bbva">BBVA Continental</option> 
                    </select>
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">Nro Operación</label>
                    <input type="text" class="form-control @error('Noperacion') is-invalid @enderror"
                        placeholder="Ingrese número de operación" id="Noperacion" name="Noperacion">
                    @error('Noperacion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">Fecha de pago</label>
                    <input type="date" class="form-control @error('fechaPago') is-invalid @enderror"
                        placeholder="Ingrese la fecha de pago" id="fechaPago" name="fechaPago">
                    @error('fechaPago')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">Monto de pago</label>
                    <input type="number" class="form-control @error('montoPago') is-invalid @enderror"
                        placeholder="Ingrese número de operación" id="montoPago" name="montoPago">
                    @error('montoPago')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="col-4">
                    <div class="col-12">
                        <label class="control-label">Archivo de Matrimonio</label>
                        <input type="file" class="form-control @error('archivo_matrimonio') is-invalid @enderror"
                            placeholder="Ingrese Archivo" name="archivo_matrimonio"
                            value="{{old('archivo_matrimonio')}}" x-data="showImage()" @change="showPreview(event)">

                        <iframe id="preview" class="object-cover h-32 mt-2 w-60" height="400vh" src="{{$ficha->ruta_certificado}}" style="display: none"> </iframe>

                        @error('archivo_matrimonio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <br>
                    </div>
                </div> --}}
            </div>
            <div class="boton_div">
                <div class="col-8 form-group flex">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                    </div>
                    
                    <div>
                        <a href="{{route('Solicitud.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
    
    $('#DNISolicitante').select2();

    $('#idActa').select2({ tags: true});
    }

    setTimeout(mensaje,500);

</script>

@endsection
