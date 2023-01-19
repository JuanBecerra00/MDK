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

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Cambiar contraseña') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
