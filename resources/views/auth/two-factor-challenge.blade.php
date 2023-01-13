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

        <div x-data="{ recovery: false }">
            <x-jet-validation-errors class="mb-4" />

            <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                {{ __('Confirme el acceso a su cuenta escribiendo el codigo de autenticacion proporcionado por su aplicacion de autenticación.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                {{ __('Confirme el acceso a su cuenta ingresando un codigo de recuperación de emergencia.') }}
            </div>


            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-input id="code" placeholder=" " class="block mt-1 w-full border-0 border-b border-black rounded-none
                    focus:border-black focus:ring-opacity-0 focus:ring-opacity-0 mt-8
                    " type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    <x-jet-label class="label duration-500" for="code" value="{{ __('Código') }}" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-input id="recovery_code" placeholder=" " class="block mt-1 w-full border-0 border-b border-black rounded-none
                    focus:border-black focus:ring-opacity-0 focus:ring-opacity-0 mt-8
                    " type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    <x-jet-label class="label duration-500" for="recovery_code" value="{{ __('Código de recuperación') }}" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="button" class="text-left text-sm text-red-600 hover:text-red-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Usar codigo de recupeación') }}
                    </button>

                    <button type="button" class="text-left text-sm text-red-600 hover:text-red-900 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Usar codigo de autenticación') }}
                    </button>

                    <x-jet-button class="ml-4">
                        {{ __('Continuar') }}
                    </x-jet-button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
