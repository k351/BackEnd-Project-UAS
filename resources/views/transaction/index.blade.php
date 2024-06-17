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
            <!-- Order Summary Column -->
            <div class="col-md-8 mb-4">
                <div class="card flex">
                    <div class="card-body">
                        <h5 class="card-title">Barang yang dibeli</h5>
                        <div class="row align-items-start mb-3">
                            <div class="col-md-4">
                                <img src="{{ asset('products/' . $product->image) }}" alt="Product Image" class="img-thumbnail"
                                    style="width: 100%;">
                            </div>
                            <div class="col-md-4">
                                <p class="mb-0 font-weight-bold">{{ $product->name }}</p>
                                <p class="mb-0 text-muted">Rp {{ number_format($product->price, 0, '', '.') }}</p>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="{{ route('transaction.checkout', ['id' => $product->id]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quantity">Jumlah</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.footer')
</body>
</html>
