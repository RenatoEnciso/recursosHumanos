@extends('dashboard')

@section('titulo', 'Registro de acta de nacimiento')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">REGISTRO DE ACTA DE NACIMIENTO</h1>
        <form method="POST" action="{{ route('ComprobantePago.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div style="display: flex">
                        

                    <div class="col-12 form-group">
                        <label class="control-label">Descripcion</label>
                        <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                            placeholder="Ingrese Descripcion" id="descripcion" name="descripcion">
                        @error('descripcion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label class="control-label">Fecha de Pago</label>
                        <input type="date" class="form-control @error('fechaPago') is-invalid @enderror"
                            id="fechaPago" name="fechaPago">
                        @error('fechaPago')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-12">
                        <label class="control-label">Archivo de Pago</label>
                        <input type="file" class="form-control @error('archivo_pago') is-invalid @enderror"
                            placeholder="Ingrese Archivo" id="archivo_pago" name="archivo_pago"
                            value="{{ old('archivo_pago') }}" x-data="showImage()" @change="showPreview(event)">
                        @error('archivo_pago')
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
                    <a href="{{ route('ComprobantePago.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
