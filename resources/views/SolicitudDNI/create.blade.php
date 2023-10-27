@extends('dashboard')

@section('titulo', 'Registro de Solicitud DNI')

@section('contenido')
    <div class="container">
        <h1 id="titulo"  class="card-title">REGISTRO DE SOLICITUD DNI AZUL</h1>
        <form method="POST" action="{{ route('solicitud-dni.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-4">
                    <label class="control-label">DNI</label>
                    <input name="DNI" id=""" class="form-control" >
                    @error('DNI')
                        <div class="alert alert-danger" >{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label class="control-label">codigo de sumnisitro de Agua</label>
                    <input name="cod_agua" id="" class="form-control" >
                    @error('cod_agua')
                        <div class="alert alert-danger" >{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label class="control-label">codigo de sumnisitro de Luz</label>
                    <input name="cod_luz" id="" class="form-control" >
                    @error('cod_luz')
                        <div class="alert alert-danger" >{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="control-label">Descripcion</label>
                    <input name="comentario" id="" class="form-control" >
                    @error('comentario')
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
                    <iframe id="preview1" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                </div>
                <div class="col-6 ">
                    <label class="control-label">Voucher </label>
                    <input type="file" class="form-control "placeholder="Ingrese Voucher" id="" name="file_voucher"
                        value="{{ old('file_voucher') }}" x-data="showImage2()" @change="showPreview2(event)" >
                    @error('file_voucher')
                        <span class="alert alert-danger" role="alert">{{ $message }} </span>
                    @enderror
                    <iframe id="preview2" class="object-cover h-32 mt-2 w-60" height="400vh"> </iframe>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-around">
                <button class="btn btn-primary"><i class="fas fa-save"></i>Grabar</button>
                <a href="" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
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

        // function mensaje() {
        
        // $('#DNISolicitante').select2();

        // $('#idActa').select2({ tags: true});
        // }
    
        // setTimeout(mensaje,500);

    </script> 

@endsection
