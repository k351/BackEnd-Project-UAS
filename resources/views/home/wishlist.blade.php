@extends('layouts.template')
@section('content')
    <div class="container mt-5 ">
        <h1> My Wishlist </h1>
        @if ($wishlists->isEmpty())
            <p>Wish list Anda kosong.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product name</th>
                            <th>Unit Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>

                                <th scope="row"> <a href="{{ route('wishlist.delete', $wishlist->id) }}">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a></th>
                                <td>{{ $wishlist->product_name }}</td>
                                <td>{{ $wishlist->product_price }}</td>
                                <td>
                                    <form class="form-inline">
                                        <button class="btn btn-warning" type="submit">Add To Cart
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{-- <div class="container my-5">
            <div class="shadow card">
                <div class="card-body">
                    @if ($wishlist->count() > 0)

                            <div class="card-body">
                                @php $total =0; @endphp
                                @foreach ($cartItems as $item)
                                    <div class ="row product_data">
                                        <div class ="my-auto col-md-2">
                                            <img src="{{ asset('') }}" </div>

                                            <div class ="my-auto col-md-3">
                                                <h6>{{ $item->product->name }}</h6>
                                            </div>

                                            <div class ="my-auto col-md-3">
                                                <h6>{{ $item->product->price }}</h6>
                                            </div>

                                            <div class ="my-auto col-md-3">
                                                <input type="hidden" class="product_id" value="{{ $items->product_id }}">
                                                @if ($item->product->Quantity >= $item->product_id)
                                                    <h6>{{ $item->product->price }}</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <h6> Total Price : Rs {{ $total }}
                                            <a href="{{ url('checkout') }}"
                                                class="btn btn-outline-success float-end">Proceed to
                                                Checkout</a>
                                        </h6>
                                    </div>
                            </div>>
                        @else
                            <div class="text-center card-body">
                                <h2>Your <i class="fa fa-shopping-cart"></i>Cart is empty</h2>
                                <a href="{{ url('category') }}" class="btn btn-outline-primary float-end">Continue
                                    Shoping</a>
                            </div>
                        @endif

                </div>
            </div>
        </div> --}}
    </div>
@endsection
