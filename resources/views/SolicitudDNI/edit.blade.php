@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo">REVISAR SOLICITUD</h1>
    <form method="POST" action="{{route("Solicitud.update",$solicitud->idSolicitud)}}">
        @method('PUT')
        @csrf
        <div class="form-row">
            <div class="col-4">
                <label class="col-form-label">DNI</label>
                <input name="DNI" id="" class="form-control" value="{{$solicitud->DNI}}" >
                @error('DNI')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="col-form-label">codigo de sumnisitro de Agua</label>
                <input name="cod_agua" id="" class="form-control" value="{{$solicitud->cod_servicio_agua}}">
                @error('cod_agua')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="col-form-label">codigo de sumnisitro de Luz</label>
                <input name="cod_luz" id="" class="form-control" value="{{$solicitud->cod_servicio_luz}}">
                @error('cod_luz')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-8">
                <label class="col-form-label">Motivo de solicitud</label>
                <input name="motivo" id="" class="form-control" value="{{$solicitud->solMotivo}}">
                @error('motivo')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label class="col-form-label">Tipo de Solicitud</label>
                <input name="tipoSolicitud" id="" class="form-control" value="1">
                @error('tipoSolicitud')
                    <div class="alert alert-danger" >{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <div class="col-12 m-2">
                    <label class="col-form-label">Foto actual</label>
                    <input type="file" class="form-control"placeholder="Ingrese foto" id="" name="file_foto"
                        value="{{ old('file_foto') }}" x-data="showImage1()" @change="showPreview1(event)" >
                    @error('file_foto')
                        <span class="alert alert-danger" role="alert">{{ $message }} </span>
                    @enderror
                </div>
                <div class="col-12 m-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFoto">
                        Ver Foto Actual
                    </button>
                    <input type="checkbox" name="valida_foto">
                    <label for="">¿Foto actual correcto?</label>
                </div>
            </div>
            <div class="col-6">
                <div class="col-12 m-2">
                    <label class="col-form-label">Voucher </label>
                    <input type="file" class="form-control "placeholder="Ingrese Voucher" id="" name="file_voucher"
                        value="{{ old('file_voucher') }}" x-data="showImage2()" @change="showPreview2(event)" >
                    @error('file_voucher')
                        <span class="alert alert-danger" role="alert">{{ $message }} </span>
                    @enderror
                </div>

                <div class="col-12 m-2">
                    <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#modalVoucher">
                        Ver voucher
                    </button>
                    <input type="checkbox" name="valida_voucher">
                    <label for="">¿Voucher correcto?</label>
                </div>
            </div>

    
            <div class="modal fade" id="modalVoucher" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Título del Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <img  src="{{asset($solicitud->file_voucher)}}"   > 
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Título del Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <img  src="{{asset($solicitud->file_foto)}}"   > 
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="form-row m-5 d-flex flex-row justify-content-center">
            <div class="card">
                <div class="card-header"> Validacion de Edad </div>
               <div class="card-body {{ ($edad>=17 && $edad<=20) ? 'bg-success' : 'bg-warning' }}">
                        <label class="">Condicion: {{$edad}} años</label>
                        <label class="d-block" for="">{{$condEdad}}</label>
                </div>
            </div>
        </div>
        
        <div class="d-flex flex-row justify-content-around">
            <button class="btn btn-success"><i class="fas fa-save"></i>Aceptar</button>
            <a href="{{route('solicitud-dni.cancelar')}}" class="btn btn-warning" ><i class="fas fa-save"></i>Rechazar</button>
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
                    }
                }
            }
        }

</script>

@endsection
