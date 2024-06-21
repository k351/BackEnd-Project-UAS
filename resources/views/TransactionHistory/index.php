<!-- resources/views/history/index.blade.php -->

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Transaction History -->
    <div class="container mx-auto">
        <h2 class="text-xl font-bold mb-4">Transaction History</h2>
        <div class="grid grid-cols-1 gap-4">
            @foreach ($transactions as $transaction)
                <div class="bg-white rounded shadow p-4">
                    <p>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>
                    <p>Total: {{ $transaction->total }}</p>
                    <!-- Tambahkan informasi transaksi lainnya sesuai kebutuhan -->
                </div>
            @endforeach
        </div>
    </div>

    <!-- Form Top-Up -->
    <div class="container mx-auto mt-8">
        <h2 class="text-xl font-bold mb-4">Top-Up</h2>
        <form action="{{ url('topping_up', $user->id) }}" method="POST">
            @csrf
            <!-- Top-Up Quantity -->
            <div class="mb-4">
                <x-input-label for="topup" :value="__('Top-up Quantity')" />
                <x-text-input id="topup" class="block mt-1 w-full" type="number" name="quantity" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Top-Up') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Link ke Transaction History -->
    <div class="container mx-auto mt-8">
        <a href="{{ route('transaction.history') }}" class="btn btn-primary">
            {{ __('Back to Transaction History') }}
        </a>
    </div>
</x-guest-layout>
