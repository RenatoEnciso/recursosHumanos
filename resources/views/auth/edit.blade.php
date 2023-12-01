
@extends('dashboard')

@section('titulo','Editar Usuario')

@section('contenido')
<div class="container">
    <div class="shadow-lg py-4 bg-body-tertiary rounded" style="margin-top:8vh">
        <h1 id="titulo" class="acta_title">Editar usuario</h1>
   
    <form method="POST" action="{{route('ActualizarPassword',$Usuarios->id)}}" method="POST" class="need-validation" novalidate >
        @csrf
        <div class="row justify-content-center">
            <div class="col-1 form-group">
                <label class="control-label">Codigo</label>
                <input type="text" style="color: blue"  class="form-control" value="{{$Usuarios->id}}" disabled>
            
            <!-- Name -->
            </div>
            <div class="col-2 form-group">
                <label class="control-label">Nombre</label>
                <input id="name"  type="text" name="name"
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
           <div class="col-3 form-group">
                <label class="control-label">Correo</label>

                <input id="email"  type="email" name="email"
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
            <div class="col-3 form-group">
                <label class="control-label">Rol</label> <br>

                    {{-- <input id="rol" class="block mt-1 w-full" type="text" name="rol"  required
                            value="{{$Usuarios->rol}}"
                    style="color: black;font-weight: bold;"
                    class="form-control @error('rol') is-invalid @enderror"
                    > --}}
                    
                    <select  name="idRol" id="rol" class="form-control @error('rol') is-invalid @enderror">

                        <option select>Seleccione un rol</option>
                        @foreach ($roles as $r)
                            <option value="{{$r->idRol}}"
                                {{$Usuarios->idRol==$r->idRol?'selected':''}}
                            >{{$r->nombreRol}}</option>
                            
                        @endforeach
                    </select>
                    @error('rol')
                    <span class="invalid feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
            </div> 
        </div> 
            
        <div class="row justify-content-center">
            <!--Rol Address -->
          

            <!-- Password -->
            <div class="col-3 form-group">
                <label class="control-label">Contraseña Actual</label>

                <input id="password_actual"  type="password"name="password_actual"
                required autocomplete="new-password" style="color: black;"
                class="form-control @error('password_actual') is-invalid @enderror"
                >
                {{-- <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword">
                  </div> --}}
                @error('password_actual')
                <span class="invalid feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="col-3 form-group">
                <label class="control-label">Contraseña Nueva</label>

                <input id="new_password"  type="password"name="new_password" required autocomplete="new-password"
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
            <div class="col-3 form-group">
                <label class="control-label">Confirmar contraseña</label>

                <input id="confirm_password" 
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
        </div>
            <br>
            
            <div class="boton_div">
                <div>
                    <button class="btn btn-primary boton"><i class="fas fa-save"></i> Actualizar</button>
                </div>
                <div>
                    <a href="{{ route('EmpleadoCancelar') }}" class="btn btn-danger boton"><i class="fas fa-ban"></i> CANCELAR</a>
                </div>
            </div>
        </div>
</div>
@endsection
