@extends('dashboard')

@section('titulo','Editar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo">EDITAR SOLICITUD</h1>
    <form method="POST" action="{{route("Solicitud.update",$Solicitud->idSolicitud)}}">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label class="control-label">CODIGO</label>
                    <input type="text" style="color: blue"  class="form-control" value="{{$Solicitud->idSolicitud}}" disabled>
                </div> 
                <div class="col-12 form-group">
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
                <div class="col-12 form-group">
                    <label class="control-label">Solicitante</label>
                    <select name="DNISolicitante" id="DNISolicitante"
                        class="form-control @error('DNISolicitante') is-invalid @enderror">
                        @foreach ($personas as $item)
                            @if ($Solicitud->DNISolicitante==$item->DNI)
                            <option selected value="{{ $item->DNI }}">DNI:{{ $item->DNI}} ,{{ $item->Nombres }} {{ $item->Apellido_Paterno}} {{ $item->Apellido_Materno}}</option> 
                            @else
                            <option value="{{ $item->DNI }}">DNI:{{ $item->DNI}} ,{{ $item->Nombres }} {{ $item->Apellido_Paterno}} {{ $item->Apellido_Materno}}</option> 
                            @endif
                        @endforeach
                    </select>
                    @error('DNISolicitante')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 form-group">
                    <label class="control-label">ACTAS A SOLICITAR</label>
                    <select name="idActa[]" id="idActa" multiple="multiple" 
                            class="form-control @error('idActa') is-invalid @enderror">
                        @foreach ($Lista_Solicitud as $itemSol)
                            @foreach($Actas_Personas as $item)
                                @if($itemSol->idActa==$item->Acta->idActa)
                                    @if($item->Acta->TipoActa->idTipoActa!='2')
                                        <option selected value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->TipoActa->nombre }} - {{$item->Persona->Nombres}}
                                        {{$item->Persona->Apellido_Paterno}}</option>
                                    @else
                                        @if ($item->Persona->sexo=='M')
                                            @foreach ($item->Acta->Acta_Persona as $item2)
                                                @if (($item->Persona->DNI)!=($item2->Persona->DNI))
                                                    <option selected value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->TipoActa->nombre }} - {{$item->Persona->Nombres}}
                                                        {{$item->Persona->Apellido_Paterno}}  y {{$item2->Persona->Nombres}} {{$item2->Persona->Apellido_Paterno}}</option> 
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @elseif($ban==0)
                                    @if($item->Acta->TipoActa->idTipoActa!='2')
                                        <option value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->TipoActa->nombre }} - {{$item->Persona->Nombres}}
                                        {{$item->Persona->Apellido_Paterno}}</option>
                                    @else
                                        @if ($item->Persona->sexo=='M')
                                            @foreach ($item->Acta->Acta_Persona as $item2)
                                                @if (($item->Persona->DNI)!=($item2->Persona->DNI))
                                                    <option  value="{{ $item->Acta->idActa }}">Acta de {{$item->Acta->TipoActa->nombre }} - {{$item->Persona->Nombres}}
                                                        {{$item->Persona->Apellido_Paterno}}  y {{$item2->Persona->Nombres}} {{$item2->Persona->Apellido_Paterno}}</option> 
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endif 
                            @endforeach
                            {{$ban=1}}
                        @endforeach 
                    </select>
                    @error('idActa')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-12 form-group">
                    <label class="control-label">Observación</label>
                    <input type="text" class="form-control @error('observacion') is-invalid @enderror"
                        placeholder="Ingrese Observación" id="observacion" name="observacion" value ={{$Solicitud->observacion}}>
                    @error('observacion')
                        <span class="invalid feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary"><i class="fas fa-save"></i>Grabar</button>
        <a href="{{route('Solicitud.cancelar')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
    </form>
</div>
<script>
    function mensaje() {
    
    $('#DNISolicitante').select2();
    $('#idActa').select2();
    }

    setTimeout(mensaje,500);
</script>

@endsection
