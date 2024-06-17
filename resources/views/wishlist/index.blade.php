@extends('layouts.template')
@section('content')
    <div class="container mt-5 " >
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
    </div>
@endsection
