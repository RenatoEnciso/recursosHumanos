<x-guest-layout>
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
                <button style="
                        text-decoration: none;
                        padding: 10px;
                        font-weight: 600;
                        font-size: 20px;
                        color: #ffffff;
                        background-color: #1883ba;
                        border-radius: 6px;
                        border: 2px solid #0016b0;">
                    Ingresar
                </button></a>

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
            </button></a>
            @endif
        @endauth
    </div>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="images/Logo-Login.png" alt="">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Correo')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!--Rol Address -->
            <div class="mt-4">
                <x-label for="rol" :value="__('Rol')" />

                <x-input id="rol" class="block mt-1 w-full" type="text" name="rol" value="Persona" readonly required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya estas Registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    </div>
</x-guest-layout>
