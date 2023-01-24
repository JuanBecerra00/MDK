<x-jet-action-section>
    <x-slot name="title">
        {{ __('Autenticacion de dos factores') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Añade seguridad adicional a tu cuenta.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Terminando de habilitar la autenticación.') }}
                @else
                    {{ __('Haz habilitado la autenticación de dos factores.') }}
                @endif
            @else
                {{ __('No haz habilitado la autenticación de dos factores.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
            <p>
                {{ __('Cuando la autenticación de dos factores se habilita, se solicitará un codigo de seguridad durante el inicio de sesión. Puede obtener ese codigo desde la aplicación de Google Authenticator.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticación de dos factores, escanee el siguiente código QR usando su aplicación de autenticación o escriba el codigo de configuración.') }}
                        @else
                            {{ __('La autenticación de dos factores esta activada, escanee el siguiente código QR usando su aplicación de autenticación o escriba el codigo de configuración') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        {{ __('Codigo de configuración') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-zinc-600 dark:text-zinc-400">
                    <p class="font-semibold">
                        {{ __('Guarda estos códigos de seguridad. Serviran para recuperar su cuenta si pierde el acceso a su aplicación de autenticación.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Habilitar') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Regenerar códigos de recuperación') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Mostrar códigos de recuperación') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            {{ __('Deshabilitar') }}
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>
