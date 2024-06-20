<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    @include('home.css')
</head>

<body>
    @include('home.header')

        <div class="container my-4">
            <h1>Keranjang</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('cart.update') }}" method="POST">
                @method("PUT")
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selectedItems[]" value="{{ $item->product->id }}">
                                </td>
                                <td>
                                    <img src="{{ asset('products/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}" style="width: 50px;">
                                    {{ $item->product->name }}
                                </td>
                                <td>Rp {{ number_format($item->product->price, 0, '', '.') }}</td>
                                <td>
                                    <input type="number" name="cart[{{ $item->product->id }}]"
                                        value="{{ $item->quantity }}" min="1" style="width: 50px;">
                                </td>
                                <td>Rp {{ number_format($item->product->price * $item->quantity, 0, '', '.') }}</td>
                                <td>
                                    <a href="{{ route('cart.delete', $item->id) }}"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary my-2">Update Keranjang</button>
            </form>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Beli</button>
            </form>
        </div>

    @include('home.footer')
</body>

</html>
