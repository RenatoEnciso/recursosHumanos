@extends('dashboard')

@section('titulo', 'Editar acta de nacimiento')

@section('contenido')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h1 id="titulo" class="card-title text-center">REVISAR SOLICITUD DNI AZUL</h1>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('sol-primera.review2', $solicitud->idSolicitud) }}">
                    @method('PUT')
                    @csrf
                    <div class="container">
                        <div class="form-row">
                            <div class="col col-8">
                                <div class="form-row">
                                    <div class="col-4">
                                        <label class="col-form-label">DNI</label>
                                        <input name="DNI" id="" class="form-control"
                                            value="{{ $solicitud->DNI }}">
                                        @error('DNI')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label">codigo de sumnisitro de Agua</label>
                                        <input name="cod_agua" id="" class="form-control"
                                            value="{{ $solicitud->cod_servicio_agua }}">
                                        @error('cod_agua')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label">Tipo de Solicitud</label>
                                        <input name="tipoSolicitud" id="" class="form-control" value="1">
                                        @error('tipoSolicitud')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label">codigo de sumnisitro de Luz</label>
                                        <input name="cod_luz" id="" class="form-control"
                                            value="{{ $solicitud->cod_servicio_luz }}">
                                        @error('cod_luz')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label">Motivo de solicitud</label>
                                        <input name="motivo" id="" class="form-control"
                                            value="{{ $solicitud->solMotivo }}">
                                        @error('motivo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label class="col-form-label">Edad</label>
                                        <input name="edad" id="idInEdad"
                                            class="form-control {{ $edad >= 17 && $edad <= 19 ? 'bg-success' : 'bg-danger' }} "
                                            value="{{ $edad }}">
                                        @error('motivo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <div class="col-12 m-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalFoto">
                                                Ver Foto Actual
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="col-12 m-2">
                                            <button type="button" class="btn btn-primary m-2" data-toggle="modal"
                                                data-target="#modalVoucher">
                                                Ver voucher
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Validacion de datos --}}
                            <div class="col col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h3><b>Revision de información:</b></h3>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <input type="checkbox" id="idCheckEdad" disabled>
                                            <label class="">Edad correcta para la solicitud (17-19)</label>
                                        </div>
                                        <div class="">
                                            <input  {{$solicitud->valida_voucher==1?'checked':''}} type="checkbox" name="valida_voucher">
                                            <label for="">Voucher correcto</label>
                                        </div>
                                        <div>
                                            <input {{$solicitud->valida_foto==1?'checked':''}} type="checkbox" name="valida_foto">
                                            <label for="">Foto actual correcto</label>
                                        </div>
                                        <div class="">
                                            <input  {{$solicitud->valida_serv_luz==1?'checked':''}} type="checkbox" name="valida_serv_luz">
                                            <label for="">Recibo de luz correcto</label>
                                        </div>
                                        <div>
                                            <input {{$solicitud->valida_serv_agua==1?'checked':''}} type="checkbox" name="valida_serv_agua">
                                            <label for="">Recibo de Agua correcto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-around">
                            <button class="btn btn-success" {{$edad>=17 && $edad<20?'':''}}>
                                <i class="fas fa-save"></i>Aceptar
                            </button>
                            <a href="{{ route('sol-primera.cancelar') }}" class="btn btn-warning">
                                <i class="fas fa-save"></i>Rechazar
                            </a>
                            <a href="{{ route('sol-primera.cancelar') }}" class="btn btn-secondary">
                                <i class="fas fa-ban"></i>Atras
                            </a>
                        </div>
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
        <script>
            var edad = parseInt(document.getElementById('idInEdad').value);
            var checkEdad = document.getElementById('idCheckEdad');
            if (edad >= 17 && edad < 20)
                checkEdad.checked = true;
            else
                checkEdad.checked = false;
        </script>
    </div>

    <div class="modal fade" id="modalVoucher" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Título del Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($solicitud->file_voucher) }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Título del Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($solicitud->file_foto) }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
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
