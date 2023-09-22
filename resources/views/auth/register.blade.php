@extends('auth.template')

@section('title', 'Registrar usuario')

@section('main')
    <form action="{{ route('register') }}" method="POST" class="register">
        @csrf
        <i class='fas fa-user-plus'></i>
        <span>Registrar usuario</span>
        <input type="text" name="name" placeholder="Nombre" class="secondary" required>
        <input type="email" name="email" placeholder="Correo" class="secondary" required>
        <select name="idRol">
            <option disabled selected>Rol</option>
            <option value="1">Mesa de partes</option>
            <option value="2">Registrador</option>
            <option value="3">Administrador</option>
            <option value="4">Administrador del sistema</option>
        </select>
        <input type="password" name="password" placeholder="Contraseña" class="secondary" required>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="secondary" required>
        <div class="bottom">
            <div style="display: flex; gap: 16px">
                <a href="{{ route('login') }}">
                    <input type="button" value="Cancelar">
                </a>
                <input type="submit" class="primary" value="Registrar">
            </div>
        </div>
    </form>
@endsection