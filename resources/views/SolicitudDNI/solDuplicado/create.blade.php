@extends('dashboard')

@section('titulo', 'Registro de Solicitud DNI')

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h1 id="titulo" class="card-title text-center">SOLICITUD DE DNI DUPLICADO</h1>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sol-duplicado.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-4">
                            <label class="control-label">DNI</label>
                            <input name="DNI" id="" class="form-control">
                            @error('DNI')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="control-label">Codigo de recibo de servicio</label>
                            <input name="codigo_recibo" id="" class="form-control">
                            @error('codigo_recibo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="control-label">Numero de voucher</label>
                            <input name="codigo_voucher" id="" class="form-control">
                            @error('codigo_voucher')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-8">
                            <label class="control-label">Motivo de solicitud</label>
                            <input name="motivo" id="" class="form-control"
                                value="Por cumplir los 17 años de edad">
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
                                        <input type="checkbox" name="valida_foto">
                                        <label for="">Adjunta foto actual</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="valida_firma">
                                        <label for="">Adjunta Firma</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-around">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Guardar</button>
                        <a href="{{ route('sol-primera.cancelar') }}" class="btn btn-danger"><i
                                class="fas fa-ban"></i>Cancelar
                        </a>
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
