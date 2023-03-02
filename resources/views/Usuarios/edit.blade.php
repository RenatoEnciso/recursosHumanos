@extends('dashboard')

@section('titulo','Editar Persona')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Editar USUARIO</h1>
    <form method="POST" action="{{route("administrador.update",$usuario->id)}}">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label class="control-label">Codigo</label>
            <input type="text" style="color: blue"  class="form-control @error('id') is-invalid @enderror"
                placeholder="Ingrese Codigo" value="{{$usuario->id}}" name="id" disabled>
        </div>
        <div class="form-group">
            <label class="control-label">Nombre</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                placeholder="Ingrese Nombre"  value="{{$usuario->name}}" name="name">
            @error('name')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label">Nueva Contraseña</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                placeholder="Ingrese Nueva Contraseña"  name="password">
            @error('password')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label">Correo Electronico</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" 
                placeholder="Ingrese correo electronico" value="{{$usuario->email}}" name="email">
            @error('email')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
        </div>

      

        <div class="form-group">
            <label class="control-label">Roles</label>
            <br>
            <select class="form-select form-select-lg mb-3" name="idRol" aria-label="Default select example" id="rol">

                <option disabled >Seleccione un rol</option>
                @foreach ($roles as $r)
                @if ($usuario->idRol==$r->idRol)
                     <option value="{{$r->idRol}}" selected>{{$r->nombreRol}}</option>  
                @else
                    <option value="{{$r->idRol}}"> {{$r->nombreRol}} </option>
                @endif
                    
                @endforeach
            </select>
        </div>
     

        <div class="boton_div" >
            <div>
                <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            </div>
       
            <div>
                <a href="{{route('administrador.cancelar')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
            </div>
            
        </div>

       
    </form>
</div>
@endsection