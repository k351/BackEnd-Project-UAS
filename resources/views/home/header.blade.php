<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="/">
            <span>
                BACKEND UAS
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ request()->is('/rekomendasi') ? 'active' : '' }}">
                    <a class="nav-link" href="/rekomendasi">Recommendation <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ request()->is('shop_page') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('shop_page') }}">
                        Shop
                    </a>
                </li>
                <li class="nav-item {{ request()->is('wishlist') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('wishlist') }}">
                        Wishlist
                    </a>
                </li>
            </ul>
            <div class="user_option">

                @if (Route::has('login'))
                    @auth
                        <form style="padding: 10px" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="btn btn-success" type="submit" value="Logout">
                        </form>

                        @if (auth()->user()->isSeller())
                            <a class="btn btn-success" href="{{ url('seller/dashboard/') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span>Add Product</span>
                            </a>
                            <a class="nav-link" href="{{ url('wallet_topup', auth()->user()->user_id())}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span>Balance: {{auth()->user()->wallet()}}</span>
                            </a>
                        @elseif(auth()->user()->isAdmin())
                            <a class="btn btn-success" href="{{ url('admin/dashboard') }}">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <span>To Dashboard</span>
                            </a>
                        @else
                            <a class="btn btn-success" href="{{ url('/register-seller') }}">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span>Become a Seller</span>
                            </a>
                            <a class="nav-link" href="{{ url('wallet_topup', auth()->user()->user_id())}}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span>Balance: {{auth()->user()->wallet()}}</span>
                            </a>
                        @endif
                    @else
                        <a href="{{ url('/login') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{ url('/register') }}">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span>Register</span>
                        </a>
                    @endauth
                @endif

                <a href="{{ route('cart.index') }}">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </a>

                <form class="form-inline" action="{{ url('product_search') }}">
                    <input type="text" id="search-box" name="search" class="form-control" style="display:none;"
                        placeholder="Search...">
                    <input type="submit" id="submit-btn" class="btn btn-success" value="Search" style="display:none;">
                    <button class="btn nav_search-btn" type="button" id="search-button" style="margin-left: 20px;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>
<!-- end header section -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchButton = document.getElementById('search-button');
        const searchBox = document.getElementById('search-box');
        const submitBtn = document.getElementById('submit-btn');

        searchButton.addEventListener('click', function() {
            if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                searchBox.style.display = 'block';
                submitBtn.style.display = 'block';
                searchButton.style.display = 'none';
            } else {
                searchBox.style.display = 'none';
                submitBtn.style.display = 'none';
                searchButton.style.display = 'block';
            }
        });
    });
</script>
