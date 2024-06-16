<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('You are trying to reset an admin account please insert the secret key') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Token -->
        <div>
            <x-input-label for="secretkey" :value="__('secretkey')" />
            <x-text-input id="secretkey" class="block mt-1 w-full" type="string" name="secretkey" :value="old('secretkey')" required autofocus />
            <x-input-error :messages="$errors->get('secretkey')" class="mt-2" />
            <input type="hidden" name="email" type="string" value="{{ session('email')}}">
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Submit Token') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
