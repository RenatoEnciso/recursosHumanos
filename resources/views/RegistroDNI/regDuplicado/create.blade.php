@extends('dashboard')

@section('titulo', 'Registro de Solicitud DNI')

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h1 id="titulo" class="card-title text-center">REGISTRO: SOLICITUD DE DNI AZUL - DUPLICADO</h1>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reg-primera.storeValido',$registro->idRegistro) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">

                        <div class="col-4">
                            <label class="col-form-label">DNI</label>
                            <input name="DNI" id="" class="form-control" value="{{ $persona->DNI }}">
                            @error('DNI')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Apellido Paterno</label>
                            <input name="apellido_paterno" id="" class="form-control"
                                value="{{ $persona->Apellido_Paterno }}">
                            @error('apellido_paterno')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Apellido Materno</label>
                            <input name="Apellido_Materno" id="" class="form-control"
                                value="{{ $persona->Apellido_Materno }}">
                            @error('Apellido_Materno')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Nombre completo</label>
                            <input name="nombres" id="" class="form-control" value="{{ $persona->Nombres }}">
                            @error('nombres')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Estado Civil</label>
                            <input name="estado_civil" id="" class="form-control"
                                value="{{ $persona->estadocivil }}">
                            @error('estado_civil')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Fecha de Nacimiento</label>
                            <input name="fecha_nacimiento" id="" class="form-control"
                                value="{{ $persona->fecha_nacimiento }}">
                            @error('fecha_nacimiento')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Departamento</label>
                            <input name="departamento" id="" class="form-control"
                                value="{{ $persona->departamento }}">
                            @error('departamento')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">provincia</label>
                            <input name="provincia" id="" class="form-control" value="{{ $persona->provincia }}">
                            @error('provincia')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">distrito</label>
                            <input name="distrito" id="" class="form-control" value="{{ $persona->distrito }}">
                            @error('distrito')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="col-form-label">Direccion Actual</label>
                            <input name="direccion" id="" class="form-control" placeholder="Validar con Recibo de servicio">
                            @error('direccion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex flex-row justify-content-around">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Registrar</button>
                        <a href="{{ route('reg-primera.cancelar',$solicitud->idSolicitud) }}" class="btn btn-danger"><i
                                class="fas fa-ban"></i>Cancelar</a>
                    </div>
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
