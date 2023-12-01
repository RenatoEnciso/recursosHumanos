@extends('dashboard')

@section('titulo','Editar acta de matrimonio')

@section('contenido')
<div class="container">
    <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
        <h1  id="titulo" class="acta_title">Editar Acta de matrimonio</h1>
        <form enctype="multipart/form-data"  method="POST" action="{{route("ActaMatrimonio.update",$ActaMatrimonio1->idActaPersona)}}">
            @method('PUT')
            @csrf
            <div class="row" style="width: 80%; margin: 0 auto">
                <div class="col-12">
                    <div class="form-group">
                        <label class="control-label">CODIGO</label>
                        <input type="text" class="form-control"style="color: blue"  value="{{$acta->idActa}}" disabled>
                    </div>
    
                    <div class="col-12 form-group">
                        <label class="control-label">Observación</label>
                        <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                            value="{{$acta->observacion}}" id="observacion" name="observacion">
                        @error('observacion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="col-12 form-group">
                        <label class="control-label">Fecha de Matrimonio</label>
                        <input type="date" class="form-control @error('fecha_matrimonio') is-invalid @enderror" id="fecha_matrimonio"
                            name="fecha_matrimonio" value="{{$acta->ActaMatrimonio->fecha_matrimonio}}">
                        @error('fecha_matrimonio')
                        <span class="invalid feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Lugar de matrimonio</label>
                        <input type="text" class="form-control @error('lugar_matrimonio') is-invalid @enderror"
                                value="{{$acta->lugar_ocurrencia}}" id="lugar_matrimonio" name="lugar_matrimonio">
                        @error('lugar_matrimonio')
                        <span class="invalid feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Esposa</label>
                        <select name="esposa" id="DNI1"  class="form-control @error('persona') is-invalid @enderror">
                            @foreach ($personas as $item)
                                @if($item->sexo=="F" && $item->estado==1)
                                    <option value="{{$item['DNI'] }}" {{$item->DNI==$ActaMatrimonio1->DNI?'selected':''}}  >
                                        {{$item['Nombres']}} {{$item['Apellido_Paterno']}} {{$item['Apellido_Materno']}}, DNI: {{$item['DNI']}}</option>
                                @endif
                            @endforeach
                        </select>
    
                        @error('persona')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label class="control-label">Esposo</label>
                        <select name="esposo" id="DNI2" class="form-control @error('persona') is-invalid @enderror">
                            @foreach ($personas as $item)
                                @if($item->sexo=="M" && $item->estado==1)
                                <option value="{{$item['DNI'] }}" {{$item->DNI==$ActaMatrimonio2->DNI?'selected':''}}  >
                                 {{$item['Nombres']}} {{$item['Apellido_Paterno']}} {{$item['Apellido_Materno']}}, DNI: {{$item['DNI']}}</option>
                                 @endif
                            @endforeach
                        </select>
                        @error('persona')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
    
                </div>
    
            </div><br>
            <div class="boton_div">
                <div>
                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                </div>
                <div>
                    <a href="{{ route('ActaMatrimonio.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
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
    $('#DNI1').select2();
    $('#DNI2').select2();
    $('#idLibro').select2();
    $('#idFolio').select2();
    }
    setTimeout(mensaje,500);
</script>
@endsection
