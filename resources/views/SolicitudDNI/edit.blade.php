@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo">EDITAR SOLICITUD</h1>
    <form method="POST" action="{{route("Solicitud.update",$solicitud->idSolicitud)}}">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="col-4">
                <label class="control-label">DNI</label>
                <input name="DNI" id="" class="form-control" value="{{$solicitud->DNI}}" >
                @error('DNI')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="control-label">codigo de sumnisitro de Agua</label>
                <input name="cod_agua" id="" class="form-control" value="{{$solicitud->cod_servicio_agua}}">
                @error('cod_agua')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="control-label">codigo de sumnisitro de Luz</label>
                <input name="cod_luz" id="" class="form-control" value="{{$solicitud->cod_servicio_luz}}">
                @error('cod_luz')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-8">
                <label class="control-label">Motivo de solicitud</label>
                <input name="motivo" id="" class="form-control" value="{{$solicitud->solMotivo}}">
                @error('motivo')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="control-label">Tipo de Solicitud</label>
                <input name="tipoSolicitud" id="" class="form-control" value="1">
                @error('tipoSolicitud')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label class="control-label">Foto actual</label>
                <input type="file" class="form-control"placeholder="Ingrese foto" id="" name="file_foto"
                    value="{{ old('file_foto') }}" x-data="showImage1()" @change="showPreview1(event)" >
                @error('file_foto')
                    <span class="alert alert-danger" role="alert">{{ $message }} </span>
                @enderror
                <iframe id="preview1" src="{{asset($solicitud->file_foto)}}" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
            </div>
            
            <div class="col-6">
                <input type="checkbox" name="valida_foto">
                <label for="">¿Foto actual correcto?</label>
            </div>
            <div class="col-6 ">
                <label class="control-label">Voucher </label>
                <input type="file" class="form-control "placeholder="Ingrese Voucher" id="" name="file_voucher"
                    value="{{ old('file_voucher') }}" x-data="showImage2()" @change="showPreview2(event)" >
                @error('file_voucher')
                    <span class="alert alert-danger" role="alert">{{ $message }} </span>
                @enderror
                <img  src="{{asset($solicitud->file_voucher)}}"   > 
                
            </div>
            <div class="col-6">
                <input type="checkbox" name="valida_voucher">
                <label for="">¿Voucher correcto?</label>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-around">
            <button class="btn btn-primary"><i class="fas fa-save"></i>Grabar</button>
            <a href="{{route('solicitud-dni.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
        </div>
            @if (session('notifica'))
            <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                {{session('notifica')}}
            </div>
            @endif
    </form>
</div>
<script>
        function showImage1() {
            return {
                showPreview1(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview1");
                        preview.src = src;
                        preview.style.display = "block";
                    }else{
                        src=$('#id_voucher').val();
                        preview.src=src;
                        preview.style.display="block";
                    }
                }
            }
        }
        function showImage2() {
            return {
                showPreview2(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview2");
                        preview.src = src;
                        preview.style.display = "block";
                    }else{
                        var preview = document.getElementById("preview2");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }

</script>

@endsection
