@extends('dashboard')

@section('titulo','Editar acta de matrimonio')

@section('contenido')
<div class="container">
    <h1  id="titulo" class="acta_title">Editar Acta de matrimonio</h1>
    <form enctype="multipart/form-data"  method="POST" action="{{route("ActaMatrimonio.update",$ActaMatrimonio1->idActaPersona)}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">CODIGO</label>
            <input type="text" class="form-control"style="color: blue"  value="{{$acta->idActa}}" disabled>
        </div>

        <div class="row">
            <div class="col-8">
                <div style="display: flex">
                    <div class="col col-6">
                        <label class="control-label">Numero de libro</label>
                        <select name="nroLibro" id="idLibro" class="form-control @error('libro') is-invalid @enderror">
                            @foreach($libros as $item)
                                <option value="{{$item['idLibro'] }}" {{$item->idLibro==$acta->idLibro?'selected':''}}> Libro
                                    {{$item['nroLibro'] }}</option>
                            @endforeach
                        </select>
                        @error('libro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col col-6">
                        <label class="control-label">Numero de Folio</label>
                        <select name="nroFolio" id="idFolio" class="form-control @error('folio') is-invalid @enderror">
                            @foreach($folios as $item)
                                <option value="{{$item['idFolio'] }}" {{$item->idFolio==$acta->idFolio?'selected':''}}  > Folio 
                                {{$item['nroFolio'] }}</option>
                            @endforeach
                        </select>
                        @error('folio')
                            <span class="invalid feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
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
                        name="fecha_matrimonio" value="{{$acta->fecha_Acta}}">
                    @error('fecha_matrimonio')
                    <span class="invalid feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12 form-group">
                    <label class="control-label">Lugar de matrimonio</label>
                    <input type="text" class="form-control @error('lugar_matrimonio') is-invalid @enderror"
                            value="{{$acta->lugar_Acta}}" id="lugar_matrimonio" name="lugar_matrimonio">
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
                                {{$item['Nombres'] }}</option>
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
                             {{$item['Nombres']}}</option>
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
            <div class="col-4">
                <div class="col-12">
                    <label class="control-label">Archivo de matrimonio</label>
                    <input type="file" class="form-control @error('archivo_matrimonio') is-invalid @enderror"
                        placeholder="Ingrese Archivo" id="archivo_matrimonio" name="archivo_matrimonio"
                        value="{{$ActaMatrimonio1->Acta->archivo }}" x-data="showImage()" @change="showPreview(event)">
                        <iframe src="{{$acta->archivo}}" id="preview" class="object-cover h-32 mt-2 w-60" style="height: 350px"> </iframe>
                    @error('archivo_matrimonio')
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
