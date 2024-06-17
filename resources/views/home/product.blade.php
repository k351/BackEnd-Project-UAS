    <section class="shop_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Latest Products
                </h2>
            </div>
            <div class="row">

                @foreach ($product as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="box">
                            <div class="img-box">
                                <img src="products/{{ $product->image }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h6>{{ $product->name }}</h6>

                                @php $exists = collect($wishlist)->contains('product_id',$product->id); @endphp
                                <!-- Product ID exists in the array -->
                                <a href="{{ route('wishlist.update', $product->id) }}">
                                    @if ($exists)
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    @endif
                                </a>
                                <h6>Price
                                    <span>{{ $product->price }}</span>
                                </h6>
                            </div>

                            <div style="padding:15px">
                                <a class="btn btn-danger" href="{{ url('product_details', $product->id) }}">Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
