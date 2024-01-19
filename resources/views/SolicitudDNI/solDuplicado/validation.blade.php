@extends('SolicitudDNI.plantilla')
@section('titulo', 'Solicitud DNI')
@section('subtitulo', 'Validación de identidad')
@section('cuerpo')
    <div class="card border-primary">
        <div class="card-body">
            <h1 class="mb-4">Estimado Usuario,</h1>
            <p class="mb-4">Para realizar tu servicio en línea, primero debes autenticarte, selecciona el tipo de
                autenticación.</p>
            <form action="{{ route('solicitudDNI.validar') }}" method="POST">
                @csrf
                <div class="form-group">
                    <h3><b>Datos Personales</b></h3>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="idDni">Numero de DNI</label>
                        <input type="text" class="form-control" id="idDni" name="dni">
                        @error('dni')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="idFechaNacimiento">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="idFechaNacimiento" name="fechaNacimiento">
                        @error('fechaNacimiento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="mt-4"><b>Lugar de Nacimiento</b></h3>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="idDepa">Departamento</label>
                        <input type="text" class="form-control" id="idDepa" name="departamento">
                        @error('departamento')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="idProv">Provincia</label>
                        <input type="text" class="form-control" id="idProv" name="provincia">
                        @error('provincia')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="idDis">Distrito</label>
                        <input type="text" class="form-control" id="idDis" name="distrito">
                        @error('distrito')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-around mt-4">
                    <button type="submit" class="btn btn-primary">Validar</button>
                    <button type="submit" class="btn btn-warning">Atras</button>
                </div>
                @if (session('respuesta'))
                    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                        style="color: white; background-color: rgb(183, 178, 31)">
                        {{ session('respuesta') }}
                    </div>
                @endif

            </form>
        </div>
        <div class="card-footer">
            @if (session('notifica'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert"
                    style="color: white; background-color: rgb(183, 178, 31)">
                    {{ session('notifica') }}
                </div>
            @endif

        </div>
    </div>

@endsection
