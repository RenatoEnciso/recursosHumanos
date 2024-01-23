@extends('dashboard')

@section('titulo', 'Registro Pago')


@section('contenido')
    <div class="container ">
        {{-- <br><br><br><br><br> --}}
        <div class="shadow-lg py-4 bg-body-tertiary rounded "style="margin-top:18vh" >
            <h1 id="titulo" class="acta_title">Registro Pago </h1>
            <form method="POST" action="{{ route('Pago.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-4 form-group">
                        <label class="control-label">Trabajador</label>
                        <select name="periodo" id="periodo" class="form-control @error('periodo') is-invalid @enderror"  >
                          
                            @foreach ($mesesFaltantesPorContrato[$contratos[0]->idContrato] as $item)
                                                <option value={{$item}}
                                                    
                                                    >{{$item}}</option> 
                            @endforeach
                        </select>
                            @error('idTrabajador')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label">Trabajador</label>
                        <select name="idContrato" id="idContrato" class="form-control @error('idContrato') is-invalid @enderror"  >
                          
                            @foreach ($contratos as $item)
                                                <option value="{{$item->idContrato}}"
                                                    
                                                    >{{ $item->entrevista->Postulacion->oferta->cargo->descripcion}}-{{ $item->trabajador->persona->Nombres}} {{ $item->trabajador->persona->Apellido_Paterno}} {{ $item->trabajador->persona->Apellido_Materno}}</option> 
                                            @endforeach
                        </select>
                            @error('idTrabajador')
                                <span class="invalid feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                                       
                  

                </div>
                <div class="row justify-content-center">
                    <div class="col-4 form-group">
                        <label class="control-label">Registro</label>
                     
                        <input type="date" class="form-control"  id="fecha" 
                            name="fechaRegistro" >
                        @error('fechaRegistro')
                            <span class="invalid feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>  
                <div class="boton_div">
                    <div class="col-8 form-group flex">
                        <div>
                            <button class="btn btn-primary boton"><i class="fas fa-save"></i> GUARDAR</button>
                        </div>
                        <div></div>
                        <div>
                            <a href="{{route('Cese.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> 
                            {{-- <a href="{{route('Oferta.cancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a> --}}
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
        $('#DNI').select2();
        $('#idLibro').select2();
        $('#idFolio').select2();
        }
        setTimeout(mensaje,100);
    </script>



<script>
    function updatePeriodoSelect() {
        var selectedContrato = document.getElementById("idContrato").value;
        var periodoSelect = document.getElementById("periodo");

        // Actualiza el primer select con los valores correspondientes al contrato seleccionado
        periodoSelect.innerHTML = '';
        @foreach ($mesesFaltantesPorContrato as $contratoId => $meses)
            @if ($contratoId == " + selectedContrato + ")
                @foreach ($meses as $item)
                    periodoSelect.innerHTML += '<option value="' + {{$item}} + '">' + {{$item}} + '</option>';
                @endforeach
            @endif
        @endforeach
    }
</script>



@endsection
