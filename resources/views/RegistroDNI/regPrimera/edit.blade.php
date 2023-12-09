@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1 id="titulo"  class="card-title text-center" >REGISTRAR SOLICITUD DNI AZUL</h1>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('reg-primera.update', $registro->idRegistro)}}">
                @method('PUT')
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
                        <input name="direccion" id="" class="form-control" value="{{$registro->direccion}}">
                        @error('direccion')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label class="col-form-label">Fecha de emision</label>
                        <input name="fecha_emision" id="" class="form-control"  value="{{$registro->dniFechaEmision}}">
                        @error('fecha_emision')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label class="col-form-label">Fecha de caducidad</label>
                        <input name="fecha_caducidad" id="" class="form-control" value="{{$registro->dniFechaCaducidad}}">
                        @error('fecha_caducidad')
                            <div class="alert alert-danger">{{ $message }}</div>
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
                        <img  src="{{$registro->file_foto}}" id="preview1"  class="object-cover h-32 mt-2 w-60" height="400vh"> 
                      
                    </div>
                    <div class="col-6 ">
                        <label class="control-label">Voucher </label>
                        <input type="file" class="form-control "placeholder="Ingrese Voucher" id="" name="file_voucher"
                            value="{{ old('file_voucher') }}" x-data="showImage2()" @change="showPreview2(event)" >
                        @error('file_voucher')
                            <span class="alert alert-danger" role="alert">{{ $message }} </span>
                        @enderror
                        <img src="{{$registro->file_firma}}" id="preview2" class=""  width="100%" >
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-around">
                    <button class="btn btn-success"><i class="fas fa-save"></i>Actualizar</button>
                    <a href="{{route('reg-primera.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
                </div>

                <div class="form-row">
                    {{-- <div class="col-6">
                        <div class="col-12 m-2">
                            <label class="col-form-label">Foto actual</label>
                            <input type="file" class="form-control"placeholder="Ingrese foto" id="" name="file_foto"
                                value="{{ old('file_foto') }}" x-data="showImage1()" @change="showPreview1(event)" >
                            @error('file_foto')
                                <span class="alert alert-danger" role="alert">{{ $message }} </span>
                            @enderror
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
                    </div> --}}

                    <!--  Modal -->
{{--                     
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
                                <img  src="{{asset($registro->file_voucher)}}"   > 
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
                                <img  src="{{asset($registro->file_foto)}}"   > 
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                </div>
            </form>
        </div>
        <div class="card-footer">       

            @if (session('notifica'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                    {{session('notifica')}}
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
