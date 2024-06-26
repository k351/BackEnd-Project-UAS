<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .statistic-block {
            margin: 20px;
        }
        .search-bar-container {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }
        .search-bar {
            margin-right: 10px;
            flex-grow: 1;
            max-width: 300px;
        }
    </style>
</head>
<body>
    <h2 class="h5 no-margin-bottom text-center">Dashboard</h2>
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row center-content">
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-user-1"></i></div><strong>Total Products</strong>
                            </div>
                            <div class="number dashtext-1">{{ $products->count() }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-contract"></i></div><strong>Total Stock</strong>
                            </div>
                            <div class="number dashtext-2">{{ $totalStock }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add Search Bar -->
    <section class="no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('seller.search') }}" method="get">
                        <div class="search-bar-container">
                            <input type="text" id="search" name="search" class="form-control search-bar" placeholder="Search for products...">
                            <button class="btn btn-danger">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Products List -->
    <section class="no-padding-bottom">
        <div class="container-fluid">
            <div class="row center-content">
                @foreach ($products as $product)
                    <div class="col-lg-4 product-block">
                        <div class="block text-center">
                            <div class="product-title">
                                <h3 class="h5">{{ $product->name }}</h3>
                                <span>Stock: {{ $product->stock }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
                <p class="no-margin-bottom">2024 UAS BACKEND</p>
            </div>
        </div>
    </footer>
</body>
</html>
