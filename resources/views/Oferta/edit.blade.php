@extends('dashboard')

@section('titulo', 'Editar acta de defunsion')

@section('contenido')
    <div class="container">
        <h1 id="titulo" class="acta_title">Editar Oferta</h1>
        <form method="POST" action="{{ route('Oferta.update', $Oferta->idOferta) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="control-label">CODIGO</label>
                <input type="text" class="form-control" style="color: blue" value="{{ $Oferta->idOferta }}" disabled>
            </div>
            <div class="row">
                <div class="col-8 form-group">
                    <label class="control-label">descripción</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        placeholder="Ingrese descripcion"  name="descripcion" value="{{$Oferta->descripcion}}">
                    @error('descripcion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-8 form-group">
                    <label class="control-label">Fecha de inicio</label>
                    ACTUAL:{{$fecha_actual}} DEL INICIO{{$Oferta->fecha_inicio}}
                    @if ($fecha_actual>=$Oferta->fecha_inicio)
                   
                        <input type="date" class="form-control"  id="fecha_inicio" 
                        name="fecha_inicio"  value="{{$Oferta->fecha_inicio}}" readonly>
                    @else
                        <input type="date" class="form-control"  id="fecha_inicio" 
                        name="fecha_inicio"  value="{{$Oferta->fecha_inicio}}">
                    @endif
                    
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">Fecha de fin</label>
                    <input type="date" class="form-control" value="{{$Oferta->fecha_fin}}" id="fecha_fin" 
                        name="fecha_fin" >
                </div>
      

                <div class="col-8 form-group">
                    <label class="control-label">Cargos</label>
                    <select name="idCargo" id="idCargo" class="form-control">
                        @foreach ($cargos as $item)
                        <option value="{{ $item->idCargo}}"  
                            {{$Oferta->idCargo==$item->idCargo?'selected':''}}>
                            {{ $item->descripcion }}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="col-8 form-group">
                    <label class="control-label">monto</label>
                    <input type="text" class="form-control @error('monto') is-invalid @enderror"
                        placeholder="Ingrese monto"  name="monto" value="{{$Oferta->monto}}"> 
                    @error('monto')
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
