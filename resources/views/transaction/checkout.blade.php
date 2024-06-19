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
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Harga {{ $cart->quantity}} Barang</span>
                                <span>Rp {{ number_format($product->price * $cart->quantity, 0, ',', '.') }} </span>
                            </li>
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
                                <span>Rp {{ number_format(($product->price * $cart->quantity + 3000), 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('transaction.create', ['id' => $product->id]) }}">
                            @csrf
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary btn-block mt-3">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')
</body>
</html>
