<!-- resources/views/transaction/history.blade.php -->

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Transaction History -->
    <div class="container mx-auto">
        <h2 class="text-xl font-bold mb-4">Transaction History</h2>
            @foreach ($transactions as $transaction)
                <div class="grid grid-cols-1 gap-4">
                <div class="bg-white rounded shadow p-4">
                    <p>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>
                    <p>Total: {{ $transaction->total }}</p>
                    <p>Barang yang dibeli :</p>
                    @foreach($transaction->transactionitems as $item)
                        <p>
                        {{$item->product->name}}
                        </p>
                        <div class="flex items-center justify-end mt-4">
                            @if (!$transaction->ratings->where('transaction_id', $item->id)->where('product_id',$item->product_id)->first())
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('rating.form', [$transaction->id, $item->product_id]) }}">
                                Rate Product
                            </a>
                            @else
                            <p class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                reviewed
                            </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
    </div>
</x-guest-layout>
