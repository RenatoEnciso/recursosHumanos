@extends('dashboard')

@section('titulo', 'Registro Entrevista')


@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">REGISTRO Entrevista </h1>
        <form method="POST" action="{{ route('Entrevista.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 form-group">
                    <label class="control-label">observacion</label>
                    <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                        placeholder="Ingrese observacion"  name="observacion">
                    @error('observacion')
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
                    <label class="control-label">Postulacion</label>
                    <select name="idPostulacion" id="idPostulacion" class="form-control">
                        @foreach ($postulacion as $item)
                               <option value="{{ $item->idPostulacion}}">{{ $item->idPostulacion }} ,Nombres:{{ $item->DNI }} </option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">estado</label>
                    <select name="estado" id="estado" class="form-control">
                        
                               <option value="1">Aprobado</option> 
                               <option value="0">Rechazado</option> 
                        
                    </select>
                </div>

               

    

                <div class="col-8 form-group flex">
                    <div>
                        <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                    </div>
                    <div></div>
                    <div>
                        <a href="/Entrevista" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
