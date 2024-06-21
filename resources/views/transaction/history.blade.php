<!-- resources/views/transaction/history.blade.php -->

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
</x-guest-layout>
