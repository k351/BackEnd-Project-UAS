<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @include('home.css')
    @include('home.header')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Belanja</h5>

                        <form method="POST" action="{{ route('transaction.create') }}">
                            @csrf
                            <ul class="list-group list-group-flush">
                                @php
                                    $total_harga = 0;
                                    $product_ids = [];
                                @endphp
                                @foreach ($cart as $cartItem)
                                    @if ($cartItem->status == 1)
                                        @php
                                            $total_harga += $cartItem->product->price * $cartItem->quantity;
                                            array_push($product_ids, $cartItem->product->id);
                                        @endphp
                                        <input type="hidden" name="product_ids[]" value="{{ $cartItem->product->id }}">

                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>{{ $cartItem->product->name }} ({{ $cartItem->quantity }})</span>
                                            <span>Rp
                                                {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}</span>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- <li class="list-group-item d-flex justify-content-between">
                                <span>Total Harga {{ $cart->quantity }} Barang</span>
                                <span>Rp {{ number_format($product->price * $cart->quantity, 0, ',', '.') }} </span>
                            </li> --}}
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Biaya Layanan</span>
                                    <span>Rp1.000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Biaya Jasa Aplikasi</span>
                                    <span>Rp2.000</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between font-weight-bold">
                                    <span>Total Tagihan</span>
                                    <span>Rp {{ number_format($total_harga + 3000, 0, ',', '.') }}</span>
                                </li>
                            </ul>


                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <button type="submit" class="mt-3 btn btn-primary btn-block">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')
</body>

</html>
