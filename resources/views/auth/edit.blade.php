
@extends('dashboard')

@section('titulo','Editar Usuario')

@section('contenido')
<div class="container">
    <h1 id="titulo" >Editar Datos del Empleado</h1>
    <form method="POST" action="{{route('ActualizarPassword',$Usuarios->id)}}" method="POST" class="need-validation" novalidate >
        @csrf
            <div class="form-group">
                <label class="control-label">Codigo</label>
                <input type="text" style="color: blue"  class="form-control" value="{{$Usuarios->id}}" disabled>
            </div>
            <!-- Name -->
            <div>
                <label class="control-label">Nombre</label>
                <input id="name" class="block mt-1 w-full" type="text" name="name"
                required autofocus
                value="{{$Usuarios->name}}" style="color: black;"
                class="form-control @error('name') is-invalid @enderror"
                >
                @error('name')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label class="control-label">Correo</label>

                <input id="email" class="block mt-1 w-full" type="email" name="email"
                value="{{$Usuarios->email}}" style="color: black;"
                required
                class="form-control @error('email') is-invalid @enderror"
                >
                @error('email')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <!--Rol Address -->
            <div class="mt-4">
                <label class="control-label">Rol</label>

                <input id="rol" class="block mt-1 w-full" type="text" name="rol"  required
                        value="{{$Usuarios->rol}}"
                  style="color: black;font-weight: bold;"
                  class="form-control @error('rol') is-invalid @enderror"
                  >
                  @error('rol')
                  <span class="invalid feedback" role="alert">
                      <strong>{{$message}}</strong>
                  </span>
                  @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="control-label">Contraseña Actual</label>

                <input id="password_actual" class="block mt-1 w-full" type="password"name="password_actual"
                required autocomplete="new-password" style="color: black;"
                class="form-control @error('password_actual') is-invalid @enderror"
                >
                @error('password_actual')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="control-label">Contraseña Nueva</label>

                <input id="new_password" class="block mt-1 w-full" type="password"name="new_password" required autocomplete="new-password"
                 style="color: black";
                 class="form-control @error('new_password') is-invalid @enderror"
                >
                @error('new_password')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="control-label">Confirmar contraseña</label>

                <input id="confirm_password" class="block mt-1 w-full"
                                type="password"
                                name="confirm_password"   style="color: black" required
                                class="form-control @error('confirm_password') is-invalid @enderror"
                >
                @error('confirm_password')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <br>
            <div >
                        <button class="btn btn-primary"> <i class="fas fa-save"></i> Actualizar</button>
            </div>
        </form>
        <br>
        <a href="{{route('EmpleadoCancelar')}}" class="btn btn-primary"><i class="fas fa-times-circle"></i>Salir</a>
</div>
@endsection
