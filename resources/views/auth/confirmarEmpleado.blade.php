@extends('dashboard');

@section('titulo','Eliminar Empleado')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar al Empleado</h1>
    <br>
    Codigo: {{$Usuarios->id}} - Nombres: {{$Usuarios->name}} - Puesto: {{$Usuarios->rol}}
    <form method="POST" action="{{route('EliminarEmpleado',$Usuarios->id)}}">
        @csrf
        <button class="btn btn-danger"><i class="fas fa-check-square"></i>SI</button>
        <a href="{{route('EmpleadoCancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>NO</a>
    </form>
</div>
@endsection
