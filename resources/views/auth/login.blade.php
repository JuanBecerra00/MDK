<x-guest-layout>
<style>
    body{
            background-color: #000000;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpolygon fill='%23220000' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23440000' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23660000' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%23880000' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%23A00' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
        }
        input:focus ~ .label{
                transform:translate(-30px, -60px) scale(0.8);
                color:black;
        }
        input:not(:placeholder-shown) ~ .label{
            transform:translate(-30px, -60px) scale(0.8);
            color:black;
        }
        .label{
            transform:translate(0px, -30px);
            color:black;
        }
</style>
<x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-application-mark class="block h-20 w-auto" />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="flex flex-col space-around h-full justify-between">
            @csrf

            <p class="text-2xl mb-10">Iniciar Sesión</p>
            <div class="">
                <div>
                    <x-jet-input id="email" class="block mt-1 w-full border-0 border-b border-black rounded-none
                    focus:border-black focus:ring-opacity-0 focus:ring-opacity-0
                    " type="email" placeholder=" " name="email" :value="old('email')" required autofocus />
                    <x-jet-label for="email" value="{{ __('Email') }}" class="label duration-500"/>
                </div>

                <div class="mt-4">
                    <x-jet-input id="password" class="block mt-1 w-full border-0 border-b border-black rounded-none
                    focus:border-black focus:ring-opacity-0 focus:ring-opacity-0
                    " type="password" placeholder=" " name="password" required autocomplete="current-password" />
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" class="label duration-500"/>
                </div>
                <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2">{{ __('Recordar') }}</span>
                </label>
                </div>
            </div>

            

            <div class="flex items-center justify-between mt-4 gap-5">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-red-600 hover:text-red-900" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste la contraseña?') }}
                    </a>
                @endif

                <x-jet-button class="w-24 h-12 duration-300 flex justify-center items-center">
                    {{ __('Continuar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
