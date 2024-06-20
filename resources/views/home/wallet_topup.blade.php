<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ url('topping_up', $user->id) }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="topup" :value="__('Top-up Quantity')" />
            <x-text-input id="topup" class="block mt-1 w-full" type="number" name="quantity" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Top-Up') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
