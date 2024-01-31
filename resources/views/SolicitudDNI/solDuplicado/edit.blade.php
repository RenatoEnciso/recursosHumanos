@extends('dashboard')

@section('titulo', 'Editar acta de nacimiento')

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h1 id="titulo" class="card-title text-center">EDITAR SOLICITUD DNI AZUL</h1>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reg-duplicado.update', $solicitud->idSolicitud) }}" >
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="col-4">
                            <label class="control-label">DNI</label>
                            <input name="DNI" id="" class="form-control" value="{{ $solicitud->DNI_Titular }}">
                            @error('DNI')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="control-label">Codigo de recibo de servicio</label>
                            <input name="codigo_recibo" id="" class="form-control"
                                value="{{ $solicitud->codigo_recibo }}">
                            @error('codigo_recibo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="control-label">Numero de voucher</label>
                            <input name="codigo_voucher" id="" class="form-control"
                                value="{{ $solicitud->codigo_voucher }}">
                            @error('codigo_voucher')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-8">
                            <label class="control-label">Motivo de solicitud</label>
                            <input name="motivo" id="" class="form-control" value="{{ $solicitud->solMotivo }}">
                            @error('motivo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="control-label">Tipo de Solicitud</label>
                            <input id="" class="form-control" value="DNI AZUL Por Primera vez" disabled>
                        </div>
                        <div class="col col-4">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <input type="checkbox" name="valida_foto" 
                                               {{ $solicitud->valida_foto == 1 ? "checked" : "" }}>
                                        <label for="">Adjunta foto actual</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="valida_firma" 
                                               {{ $solicitud->valida_firma == 1 ? "checked" : "" }}>
                                        <label for="">Adjunta Firma</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-around">
                        <button class="btn btn-success" type="submit"><i class="fas fa-save"></i>Actualizar</button>
                        <a href="{{ route('reg-duplicado.cancelar') }}" class="btn btn-danger"><i
                                class="fas fa-ban"></i>Cancelar</a>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                @if (isset($notifica))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(183, 178, 31)">
                        {{ $notifica }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
