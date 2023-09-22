<x-guest-layout >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<div style="background: url(images/fondoLogin.jpg) rgba(0, 0, 0, 0.5); 
    height: 100%;
    background-repeat: no-repeat; 
    background-size: cover;
    background-blend-mode: darken ">

    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                <button style=" text-decoration: none;
                padding: 10px;
                font-weight: 600;
                font-size: 20px;
                color: #ffffff;
                background-color: #1883ba;
                border-radius: 6px;
                border: 2px solid #0016b0;
                "> Ingresar</button>
            </a>
            <!-- Example single danger button -->
            <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Consulta Actas
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('ConsultaNacimiento')}}">Acta Nacimiento</a></li>
                <li><a class="dropdown-item" href="{{route('ConsultaDefuncion')}}">Acta Defuncion</a></li>
                <li><a class="dropdown-item" href="{{route('ConsultaMatrimonio')}}">Acta Matrimonio</a></li>
            </ul>
            </div>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
                <button style="
                        text-decoration: none;
                        padding: 10px;
                        font-weight: 600;
                        font-size: 20px;
                        color: #ffffff;
                        background-color: #22997f;
                        border-radius: 6px;
                        border: 2px solid #0016b0;">
                    Registrarse
                </button>
                </a>
            @endif
        @endauth
    </div>
    
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="images/Logo-Login.png" alt="">
            </a>
        </x-slot>
 
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Correo')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Ingresar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</div>


</x-guest-layout>
