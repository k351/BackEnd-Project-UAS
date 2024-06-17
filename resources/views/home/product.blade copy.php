    <section class="shop_section layout_padding">
        <div class="container">
        <div class="heading_container heading_center">
            <h2>
            Latest Products
            </h2>
        </div>
        <div class="row">

            @foreach($product as $prod)
            <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
                <a href="">
                <div class="img-box">
                    <!-- <img src="products/{{$prod->image}}" alt=""> -->
                </div>
                <div class="detail-box">
                    <h6>{{$prod->name}}</h6>
@php
$exists = collect($wishlist)->contains('product_id',$prod->id);
@endphp

        <!-- Product ID exists in the array -->
        <a href="{{ route('wishlist.update', $prod->id)}}">

                    @if ($exists)
                            <i class="fa fa-heart" aria-hidden="true"></i>
                    @else
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                @endif
                </a>
                    <h6>Price
                    <span>{{$prod->price}}</span>
                    </h6>
                </div>
                </a>
            </div>
            </div>

            @endforeach
        </div>
        </div>
    </section>
