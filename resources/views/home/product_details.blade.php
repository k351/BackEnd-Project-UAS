<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style type="text/css">
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .box {
            margin-left: 140px;
        }

        .detail-box {
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="hero_area" style="display: flex; flex-direction: column;">
        <div style="display:flex; justify-content:end;width: 20%; text-align: right; align-self:flex-end">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
             @endif
        </div>
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>

    <!-- Product details start -->

    <section class="shop_section layout_padding">
        <div class="container" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div class="row">
                <div class="col-md-10">
                    <div class="box">
                        <div class="div_center">
                            <img width="400" src="/products/{{ $data->image }}" alt="">
                        </div>



                        <div class="detail-box">
                            <h6>{{ $data->name }}</h6>
                            <h6>Price
                                <span>{{ $data->price }}</span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <h6>Shop: {{ $data->shop->shop_name }}</h6>
                            <h6>Available Quantity
                                <span>{{ $data->stock }}</span>
                            </h6>
                        </div>

                        <div class="detail-box">
                            <h6>Category: {{ $data->category->category_name }}</h6>
                        </div>

                        <div class="detail-box">
                            <h6>Average Rating:
                                <span>
                                    @php
                                        $rating = $data->ratings->avg('rating') ?? 0;
                                        $fullStars = floor($rating);
                                        $halfStar = ceil($rating - $fullStars) ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </span>
                        </div>

                        <div class="detail-box">
                            <p>{{ $data->description }}</p>
                            </h6>
                        </div>


                    </div>
                    <div class="box">
                        <h6><b>Ratings</b></h6>
                        @if(empty($rate))
                            <h6>No rating yet!</h6>
                        @else
                            @foreach($rate as $ratings)
                                <h6>User {{$ratings->customer_id}}</h6>
                                @php
                                    $rating = $ratings->rating;
                                    $fullStars = floor($rating);
                                    $halfStar = ceil($rating - $fullStars) ? 1 : 0;
                                    $emptyStars = 5 - $fullStars - $halfStar;
                                @endphp

                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor

                                @if ($halfStar)
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @endif

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star text-warning"></i>
                                @endfor

                                <p>{{$ratings->review}}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div style="display: flex; align-self: center">
                <div class="mt-4 mr-4 text-center">
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $data->id }}">
                        <button type="submit" class="btn btn-primary" style="background: blue; color: white;">
                            Add to Cart
                        </button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('transaction.index', $data->id) }}" class="btn btn-primary"
                        style="background:green; color:white">Checkout</a>
                </div>

            </div>

        </div>
    </section>



    <!-- product details end-->


    <!-- info section -->
    @include('home.footer')
</body>

</html>
