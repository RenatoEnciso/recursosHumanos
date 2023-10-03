@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">Editar Cargo</h1>
        <form method="POST" action="{{ route('Cargo.update', $Cargo->idCargo) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="control-label">CODIGO</label>
                <input type="text" class="form-control" style="color: blue" value="{{ $Cargo->idCargo }}" disabled>
            </div>
            <div class="row">
                <div class="col-8 form-group">
                    <label class="control-label">descripción</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        placeholder="Ingrese descripcion"  name="descripcion" value="{{$Cargo->descripcion}}">
                    @error('descripcion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
           
                    

                    
            <div class="boton_div">
                <div>
                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                </div>
                <div>
                    <a href="{{ route('ActaDefunsion.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
