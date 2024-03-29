<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <link rel="icon" type="image/png" href="https://img.icons8.com/doodle/48/newsletter.png">
        
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Confirma') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
