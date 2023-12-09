@extends('dashboard')

@section('titulo','Eliminar acta de nacimiento')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Archivo solicitado</h1>
    <br>
   
    <img src="{{$acta->archivo}}" alt="imagen del archivo" width="500px" height="200px">
    <form method="POST" action="{{route('Solicitud.index')}}">
        @csrf
        <a href="{{route('Solicitud.cancelar')}}" class="btn btn-warning"><i class="fa fa-undo"></i>Regresar</a>
    </form>
</div>
@endsection