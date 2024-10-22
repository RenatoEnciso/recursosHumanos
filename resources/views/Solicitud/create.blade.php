@extends('dashboard')

@section('titulo', 'Registro de acta de nacimiento')

@section('contenido')
    <div class="container">
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh; margin-bottom:18vh">
            <h1 id="titulo"  class="row justify-content-center">REGISTRO DE SOLICITUD</h1>
            <form method="POST" action="{{ route('Solicitud.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-8 form-group">
                        <label class="control-label">Solicitante</label>
                        <select name="DNISolicitante" id="DNISolicitante"
                            class="form-control @error('DNISolicitante') is-invalid @enderror" >
                            @foreach ($personas as $item)
                                <option value="{{ $item->DNI }}">DNI:{{ $item->DNI}} - {{ $item->Nombres }} {{ $item->Apellido_Paterno}} {{ $item->Apellido_Materno}}</option> 
                            @endforeach
                        </select>
                        
                        @error('DNISolicitante')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-8 form-group">
                        <label class="control-label">ACTAS A SOLICITAR</label>
                        <select name="idActa[]" id="idActa"
                            class="form-control @error('idActa') is-invalid @enderror"  multiple="multiple">
                        @foreach ($Actas_Personas as $item)
                            @if ($item->Acta->ficha->idtipo!=2)
                                <option value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->ficha->tipo->nombre }} - {{$item->Persona->Nombres}}
                                {{$item->Persona->Apellido_Paterno}}</option>
                            @else
                                @if ($item->Persona->sexo=='M')
                                    @foreach ($item->Acta->Acta_Persona as $item2)
                                        @if (($item->Persona->DNI)!=($item2->Persona->DNI))
                                        <option value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->ficha->tipo->nombre }} - {{$item->Persona->Nombres}}
                                            {{$item->Persona->Apellido_Paterno}}  y {{$item2->Persona->Nombres}}
                                            {{$item2->Persona->Apellido_Paterno}}</option> 
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                        </select>
                        @error('idActa')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-8 form-group">
                        <label class="control-label">Observación</label>
                        <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                            placeholder="Ingrese Observación" id="observacion" name="observacion">
                        @error('observacion')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-8 form-group">
                        <?php $fcha = date("Y-m-d");?>
                        <label class="control-label">Fecha de Solicitud</label>
                        <input type="date" class="form-control @error('fechaSolicitud') is-invalid @enderror"
                            id="fechaSolicitud" name="fechaSolicitud" value="<?php echo $fcha;?>" disabled style="color:black">
                        @error('fechaSolicitud')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                </div>
                <div class="boton_div">
                    <div class="col-8 form-group flex">
                        <div>
                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GRABAR</button>
                        </div>
                        
                        <div>
                            <a href="{{route('Solicitud.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showImage() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>
    <script>
        function mensaje() {
        
        $('#DNISolicitante').select2();

        $('#idActa').select2({ tags: true});
        }
    
        setTimeout(mensaje,500);

    </script>

@endsection
