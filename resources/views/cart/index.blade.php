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
            @method('PUT')
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
                            <td><input type="hidden" name="selectedItems[{{ $item->id }}]"
                                value="0">
                                <input type="checkbox"name="selectedItems[{{ $item->id }}]"
                                    value="{{ $item->product->id }}" id="item_{{ $item->id }}"
                                    @if ($item->status == 1) checked @endif>
                            </td>
                            <td>
                                <img src="{{ asset('products/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}" style="width: 50px;">
                                {{ $item->product->name }}
                            </td>
                            <td>Rp {{ number_format($item->product->price, 0, '', '.') }}</td>
                            <td>
                                <input type="number" name="cart[{{ $item->id }}]" value="{{ $item->quantity }}"
                                    min="1" style="width: 50px;">
                            </td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 0, '', '.') }}</td>
                            <td>
                                <a href="{{ route('cart.delete_cart_item', $item->id) }}"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($errors->any())
                <div class="mt-3 mb-4 alert alert-danger">
                    <ul style="margin-bottom: 0px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif
            <button type="submit" class="my-2 btn btn-primary">Update Keranjang</button>
        </form>

        <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <!-- Hidden input field to store selected items -->
            <input type="hidden" id="selectedItemsInput" name="selectedItems">

            <button type="button" onclick="prepareCheckout()" class="btn btn-success">Beli</button>
        </form>



        <script>
            function prepareCheckout() {
                // Find all checked checkboxes in the table
                var selectedItems = [];
                var checkboxes = document.querySelectorAll('input[name="selectedItems[]"]:checked');

                checkboxes.forEach(function(checkbox) {
                    selectedItems.push(checkbox.value);
                });

                // Set the value of hidden input field to selected items
                document.getElementById('selectedItemsInput').value = JSON.stringify(selectedItems);

                // Submit the form
                document.getElementById('checkoutForm').submit();
            }
        </script>
    </div>

    @include('home.footer')
</body>

</html>
