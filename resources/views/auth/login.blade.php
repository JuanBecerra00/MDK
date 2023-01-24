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

            <div class="flex justify-between items-center"><p class="text-2xl mb-10">Iniciar Sesión</p><a href="/Manual.pdf" class="mb-10"><div class="w-8 p-1 bg-red-800 cursor-pointer rounded text-white"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Manual</title><path d="M160 164s1.44-33 33.54-59.46C212.6 88.83 235.49 84.28 256 84c18.73-.23 35.47 2.94 45.48 7.82C318.59 100.2 352 120.6 352 164c0 45.67-29.18 66.37-62.35 89.18S248 298.36 248 324" fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="40"/><circle fill="currentColor" cx="248" cy="399.99" r="32"/></svg></div></a></div>
            <div class="">
                <div>
                    <input id="email" class="dark:bg-white block mt-1 w-full border-0 border-b border-black rounded-none
                    focus:border-black focus:ring-opacity-0 focus:ring-opacity-0
                    " type="email" placeholder=" " name="email" :value="old('email')" required autofocus />
                    <x-jet-label for="email" value="{{ __('Email') }}" class="label duration-500"/>
                </div>

                <div class="mt-4">
                    <input id="password" class="dark:bg-white block mt-1 w-full border-0 border-b border-black rounded-none
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
