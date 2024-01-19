@extends('SolicitudDNI.plantilla')
@section('titulo', 'Solicitud DNI')
@section('subtitulo','Duplicado de DNI')
@section('cuerpo')

<div class="container mt-4">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            <h1 class="text-center">DATOS PERSONALES</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('sol-duplicado.store',$persona->DNI) }}">
                @csrf
                <div class="form-group">
                    <h3><b>Datos Personales del Solicitante</b></h3>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label class="col-form-label">DNI</label>
                        <input name="DNI" id="" class="form-control" value="{{ $persona->DNI }}">
                        @error('DNI')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Apellido Paterno</label>
                        <input name="apellido_paterno" id="" class="form-control"
                            value="{{ $persona->Apellido_Paterno }}">
                        @error('apellido_paterno')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Apellido Materno</label>
                        <input name="Apellido_Materno" id="" class="form-control"
                            value="{{ $persona->Apellido_Materno }}">
                        @error('Apellido_Materno')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Nombre completo</label>
                        <input name="nombres" id="" class="form-control" value="{{ $persona->Nombres }}">
                        @error('nombres')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Estado Civil</label>
                        <input name="estado_civil" id="" class="form-control"
                            value="{{ $persona->estadocivil }}">
                        @error('estado_civil')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Fecha de Nacimiento</label>
                        <input name="fecha_nacimiento" id="" class="form-control"
                            value="{{ $persona->fecha_nacimiento }}">
                        @error('fecha_nacimiento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Departamento</label>
                        <input name="departamento" id="" class="form-control"
                            value="{{ $persona->departamento }}">
                        @error('departamento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">provincia</label>
                        <input name="provincia" id="" class="form-control" value="{{ $persona->provincia }}">
                        @error('provincia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">distrito</label>
                        <input name="distrito" id="" class="form-control" value="{{ $persona->distrito }}">
                        @error('distrito')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Direccion Actual</label>
                        <input name="direccion" id="" class="form-control" value="{{$persona->direccion}}">
                        @error('direccion')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <h3><b>Información de contacto</b></h3>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label class="col-form-label">Telefono</label>
                        <input name="telefono" id="" class="form-control">
                        @error('telefono')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Correo Electronico</label>
                        <input type="email" name="correo" id="" class="form-control">
                        @error('correo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <h3><b>Información de Denuncia</b></h3>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label class="col-form-label">Motivo de solicitud</label>
                        <input name="motivo" id="" class="form-control" placeholder="Perdida / robo">
                        @error('motivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Codigo de denuncia</label>
                        <input name="denuncia" id="" class="form-control">
                        @error('denuncia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Fecha de denuncia</label>
                        <input type="date" name="fechadenuncia" id="" class="form-control">
                        @error('fechadenuncia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Comisaria</label>
                        <input name="comisaria" id="" class="form-control">
                        @error('comisaria')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <h3><b>Información del Pago</b></h3>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label class="col-form-label">Numero de Operación</label>
                        <input name="motivo" id="" class="form-control" placeholder="Perdida / robo">
                        @error('motivo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Fecha de pago</label>
                        <input type="date" name="denuncia" id="" class="form-control">
                        @error('denuncia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Monto de pago</label>
                        <input name="fechadenuncia" id="" class="form-control">
                        @error('fechadenuncia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-form-label">Lugar de pago</label>
                        <input name="comisaria" id="" class="form-control">
                        @error('comisaria')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-around mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Confirmar y Enviar</button>
                    <a href="{{ route('sol-duplicado.formValidar') }}" class="btn btn-danger"><i
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

