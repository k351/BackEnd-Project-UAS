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
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('wishlist.move_to_cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="wishlist_id" value="{{ $wishlist->id }}">
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
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
