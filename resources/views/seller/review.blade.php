<!DOCTYPE html>
<html>
<head>
    @include('seller.css')
    <style>
        .search-bar-container {
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between; 
        }
        .search-bar {
            margin-right: 10px;
            flex-grow: 1;
        }
        .user-actions-container {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }
        .user-actions-container form {
            flex: 1;
            margin: 0 2px;
        }
    </style>
</head>
<body>
    @include('seller.header')
    @include('seller.sidebar')
    <div class="page-content">
        <div class="page-header">
            <section class="no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('seller.rating.search') }}" method="get">
                                <div class="search-bar-container">
                                    <input type="text" id="search" name="search" class="form-control search-bar" placeholder="Search for products...">
                                    <button class="btn btn-danger">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container-fluid">
                <!-- Product Blocks with Ratings -->
                <section class="no-padding-bottom">
                    <div class="container-fluid">
                        <div class="row" id="product-list">
                            @foreach ($products as $product)
                                @foreach ($product->ratings as $rating)
                                    <div class="col-lg-4 product-block">
                                        <div class="block text-center">
                                            <div class="avatar">
                                                <img height="120px" width="120px" src="{{ asset('products/' . $product->image) }}">
                                            </div>
                                            <div class="product-title">
                                                <h3 class="h5">{{ $product->name }}</h3>
                                                <span>Transaction ID: {{ $rating->transaction_id }}</span>
                                            </div>
                                            <div class="rating-info">
                                                <div>Review by: {{ $rating->customer->name }}</div>
                                                <div>Rating: {{ $rating->rating }}</div>
                                                <div>Review: 
                                                    @php
                                                        $words = explode(' ', $rating->review);
                                                        $limitedWords = array_slice($words, 0, 50);
                                                        $limitedReview = implode(' ', $limitedWords);
                                                    @endphp
                                                    {{ $limitedReview }}{{ count($words) > 50 ? '...' : '' }}
                                                </div>                                                
                                            </div>
                                            @if(!($rating->report))
                                                <form action="{{route('report.user', ['id' => $rating->customer_id, 'rating_id' => $rating->id])}}" method="get">
                                                    <button class="btn btn-danger">Report</button>
                                                </form>
                                            @else
                                                <p>Reported</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>
</html>
