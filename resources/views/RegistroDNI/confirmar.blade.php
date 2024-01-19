@extends('dashboard')

@section('titulo','Eliminar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar esta Solicitud?</h1>
    <br>
    Codigo : {{$Solicitud->idSolicitud}} - DNI: {{$Solicitud->DNISolicitante}}
    <form method="POST" action="{{route('Solicitud.destroy',$Solicitud->idSolicitud)}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Solicitud.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection