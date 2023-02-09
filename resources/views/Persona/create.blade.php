@extends('dashboard')

@section('titulo','Registro de Personas')

@section('contenido')
<div class="container">
    <h1 id="titulo"  class="card-title">REGISTRO DE PERSONAS</h1>
    <form method="POST" action="{{route('Persona.store')}}">
        @csrf

            <div id="mensaje">
                @if (session('datos'))
                <div class="alert alert-warning alert-dismissible fade show mt-3 emergente" role="alert" style="color: white; background-color: rgb(183, 178, 31)" >
                    {{session('datos')}}
                </div>
                @endif
            </div>
        <div class="form-group">
            <label class="control-label">N° DNI</label>
            <input type="text" class="form-control @error('dni') is-invalid @enderror"
                placeholder="Ingrese DNI"  name="dni">
            @error('dni')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label">Apellido Paterno</label>
            <input type="text" class="form-control @error('apellido1') is-invalid @enderror"
                placeholder="Ingrese Apellido paterno"  name="Apellido1">
            @error('apellido2')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="control-label">Apellido Materno</label>
            <input type="text" class="form-control @error('apellido2') is-invalid @enderror"
                placeholder="Ingrese Apellido Materno" name="Apellido2">
            @error('apellido2')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label">Nombres Completos</label>
            <input type="text" class="form-control @error('nombres') is-invalid @enderror"
                placeholder="Ingrese nombres" name="nombres">
            @error('nombres')
            <span class="invalid feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div>GENERO:</div>
            <div class="form-check">
                <input checked class="form-check-input @error('sexo') is-invalid @enderror" type="radio"
                        name="sexo" id="idMasculino" value="M"  >
                <label class="form-check-label" for="idMasculino"> Masculino </label>
            </div>
            <div class="form-check">
                <input class="form-check-input  @error('sexo') is-invalid @enderror" type="radio"
                        name="sexo" id="idFemenino" value="F" >
                <label class="form-check-label" for="idFemenino"> Femenino</label>
            </div>

            @error('sexo')
                <div class="invalid-feedback">
                    <span>{{$message}}</span>
                </div>
            @enderror

        <div >
            <button class="btn btn-primary"> <i class="fas fa-save"></i>Guardar</button>
            <a href="{{route('Persona.cancelar')}}" class="btn btn-danger" > <i class="fas fa-ban"></i>Cancelar</a>
        </div>
    </form>
</div>
@endsection
