@extends('auth.template')

@section('title', 'Iniciar sesión')

@section('main')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <img src="{{URL::asset('images/logo.png')}}">
        <input type="email" name="email" placeholder="Correo" class="primary" required>
        <input type="password" name="password" placeholder="Contraseña" class="primary" required>
        <input type="submit" class="hide">
    </form>
@endsection

@section('footer')
    <footer>
        <a href="{{ route('login') }}" class='active'>
            <div class="active">
                <i class='fas fa-user-alt'></i>
            </div>
            <span >Iniciar sesión</span> 
        </a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}">
            <div>
                <i class='fas fa-user-plus'></i>
            </div>
            <span>Registrar</span> 
        </a>
        @endif
        <a href="#">
            <div>
                <i class='fas fa-file-export'></i> 
            </div>    
            <span>Consultar trámite</span> 
        </a>
        <a href="#">
            <div>
                <i class='fas fa-address-card'></i>
            </div>
            <span>Solicitar DNI</span> 
        </a>
    </footer>
@endsection