@extends('dashboard')

@section('titulo', 'Registro Cargo')


@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">REGISTRO Cargo </h1>
        <form method="POST" action="{{ route('Cargo.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8 form-group">
                    <label class="control-label">descripción</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        placeholder="Ingrese descripcion"  name="descripcion">
                    @error('descripcion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-8 form-group flex">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                    </div>
                    <div></div>
                    <div>
                        <a href="/Cargo" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                        {{-- <a href="{{route('Cargo.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
                    </div>
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
