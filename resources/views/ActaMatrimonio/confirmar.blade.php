@extends('dashboard')

@section('titulo','Eliminar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" class="acta_title">Desea eliminar esta Acta de MATRIMONIO?</h1>
    <br>
    <div class="info_confirmacion">
        <h2><b>Codigo</b> : {{$ActaMatrimonio->idActa}} <br> <b>Esposa:</b> {{$ActaMatrimonio->Persona->Nombres." ".$ActaMatrimonio->Persona->Apellido_Paterno." ".$ActaMatrimonio->Persona->Apellido_Materno}} <br> <b>Esposo: </b>
            @foreach ($ActasMatrimonio as $item1)
                                @if ($item1->Persona->sexo=='F')
                                        @foreach ($ActasMatrimonio as $item2)
                                            @if (($item1->Acta->idActa)==($item2->Acta->idActa) && ($item1->Persona->DNI)!=($item2->Persona->DNI))
                                                {{$item2->Persona->Nombres." ".$item2->Persona->Apellido_Paterno." ".$item2->Persona->Apellido_Materno }}
                                            @endif
                                        @endforeach
                                @endif
                            @endforeach
        </h2>
    </div>
    <form method="POST" action="{{route('ActaMatrimonio.destroy',$ActaMatrimonio->idActaPersona)}}">
        @method('delete')
        @csrf

        <div class="boton_div_confirmar">
            <div>
                <button class="btn btn-danger boton"><i class="fas fa-check-square"></i> SI</button>
            </div>
            <div>
                <a href="{{route('ActaMatrimonio.cancelar')}}" class="btn btn-primary boton"><i class="fas fa-times-circle"></i> NO</a>
            </div>
        </div>
    </form>
</div>
@endsection
