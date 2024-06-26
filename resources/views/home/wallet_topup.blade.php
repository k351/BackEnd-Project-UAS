<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form action="{{ url('topping_up', $user->id) }}" method="POST">
        @csrf

        <!-- Top-up Quantity -->
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

    <!-- Button for Transaction History -->
    <a href="{{ route('transaction.history') }}" class="btn btn-primary mt-4">Transaction History</a>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('node_modules/toastr/build/toastr.min.css') }}">

    <!-- Toastr JS -->
    <script src="{{ asset('node_modules/toastr/build/toastr.min.js') }}"></script>

    <!-- Display Toastr notification if a flash message is set -->
    <script>
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
</x-guest-layout>
