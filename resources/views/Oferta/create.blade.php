@extends('dashboard')

@section('titulo', 'Registro Oferta')


@section('contenido')
    <div class="container">
        <br><br><br><br><br>
        <div class="shadow-lg py-4 bg-body-tertiary rounded">
            <h1 id="titulo" class="acta_title">Registro Oferta </h1>
            <form method="POST" action="{{ route('Oferta.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label class="control-label">Descripción</label>
                            <textarea  type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                placeholder="Ingrese descripcion"  name="descripcion" ></textarea >
                        @error('descripcion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4 form-group">
                        <label class="control-label">Fecha de inicio</label>
                        <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                            name="fecha_inicio" >
                        @error('fecha_inicio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label">Fecha de fin</label>
                        <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror"  
                            name="fecha_fin" >
                        @error('fecha_fin')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label class="control-label">Cargo</label>
                        <select name="idCargo" id="idCargo" class="form-control">
                            @foreach ($cargos as $item)
                                <option value="{{ $item->idCargo}}">{{ $item->descripcion }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-8 form-group">
                        <label class="control-label">Monto(S/.)</label>
                        <input type="text" class="form-control @error('monto') is-invalid @enderror"
                            placeholder="Ingrese monto"  name="monto">
                        @error('monto')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="boton_div">
                    <div class="col-8 form-group flex">
                        <div>
                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                        </div>
                        <div></div>
                        <div>
                            <a href="/Oferta" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                            {{-- <a href="{{route('Oferta.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
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
        $("#idCargo").select2({
        dropdownAutoWidth : true
        });
        }
        setTimeout(mensaje,500);

    </script>

@endsection
