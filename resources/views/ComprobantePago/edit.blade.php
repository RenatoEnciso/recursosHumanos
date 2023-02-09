@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">EDITAR ACTA DE NACIMIENTO</h1>
    <form method="POST" action="{{route("ComprobantePago.update",$ComprobantePago->idComprobante)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">CODIGO</label>
            <input type="text" style="color: blue"  class="form-control" value="{{$ComprobantePago->idComprobante}}" disabled >
        </div>
    
        <div class="row">
            <div class="col-8">
               
                <div class="col-12 form-group">
                    <label class="control-label">Descripcion</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                        placeholder="Ingrese Descripcion" id="descripcion" name="descripcion" value="{{$comprobantePago->descipcion}}" >
                    @error('descripcion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 form-group">
                    <label class="control-label">Fecha de Pago</label>
                    <input type="date" class="form-control @error('fechaPago') is-invalid @enderror"
                        id="fechaPago" name="fechaPago" value="{{$comprobantePago->fechaPago}}">
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
                    value="{{ $comprobantePago->archivo }}" x-data="showImage()" @change="showPreview(event)">
                    <iframe src="{{$comprobantePago->archivo}}" id="preview" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                    @error('archivo_pago')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
{{-- 
            <div class="col-12 form-group">
                <label class="control-label">Persona</label>
                <select name="dniPersona" id="DNI" class="form-control @error('persona') is-invalid @enderror">
                    @foreach ($personas as $item)
                        <option value="{{$item['DNI'] }}" {{$item->DNI==$ComprobantePago->DNI?'selected':''}}  >
                            {{$item['Nombres'] }}</option>
                    @endforeach
                </select>
                @error('persona')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div> --}}

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
    setTimeout(mensaje,500);
</script>
@endsection
