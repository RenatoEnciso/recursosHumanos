@extends('dashboard')

@section('titulo', 'Registro Postulacion')


@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">REGISTRO POSTULACION </h1>
        <form method="POST" action="{{ route('Postulacion.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 form-group">
                    <label class="control-label">curriculum</label>
                    <input type="file" class="form-control @error('curriculum') is-invalid @enderror"
                        placeholder="Ingrese curriculum"  name="curriculum">
                    @error('curriculum')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              
               
                <div class="col-8 form-group">
                    <label class="control-label">Fecha</label>
                    <input type="date" class="form-control" value="" id="fecha" 
                        name="fecha" >
                </div>
      
                <div class="col-8 form-group">
                    <label class="control-label">Oferta</label>
                    <select name="idOferta" id="idOferta" class="form-control">
                        @foreach ($ofertas as $item)
                               <option value="{{ $item->idOferta}}">{{ $item->idOferta }}</option> 
                        @endforeach
                    </select>
                </div>

                <div class="col-8 form-group">
                    <label class="control-label">Persona</label>
                    <select name="DNI" id="DNI" class="form-control">
                        @foreach ($personas as $item)
                               <option value="{{ $item->DNI}}">{{ $item->Nombres }}</option> 
                        @endforeach
                    </select>
                </div>
                

    

                <div class="col-8 form-group flex">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                    </div>
                    <div></div>
                    <div>
                        <a href="/Postulacion" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                        {{-- <a href="{{route('Entrevista.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
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
