@extends('dashboard');

@section('titulo','Eliminar Persona')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar Perona</h1>
    <br>
    DNI: {{$persona->DNI}} - Nombres: {{$persona->Apellido_Paterno}}
    <form method="POST" action="{{route('Persona.destroy',$persona->DNI)}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('Persona.cancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection