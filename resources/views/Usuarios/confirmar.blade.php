@extends('dashboard')

@section('titulo','Eliminar Persona')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Desea eliminar al usuario</h1>
    <br>
    @if (session('datos'))
    <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
        {{session('datos')}}
    </div>
    @endif
    <div class="info_confirmacion">
        <h2>Codigo : {{$usuario->id}} - Nombre: {{$usuario->name}} - Correo Electronico: {{$usuario->email}}</h2>
    </div>
    <form method="POST" action="{{route('administrador.destroy',$usuario->id)}}">
        @method('delete')
        @csrf
        <div class="boton_div_confirmar">
            <div>
                <button class="btn btn-danger boton"><i class="fas fa-check-square"></i> SI</button>
            </div>
            <div>
                <a href="{{route('administrador.cancelar')}}" class="btn btn-primary boton"><i class="fas fa-times-circle"></i> NO</a>
            </div>
        </div>
    </form>
</div>
@endsection