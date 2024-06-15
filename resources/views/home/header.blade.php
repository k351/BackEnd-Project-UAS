<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.html">
        <span>
          Backend UAS
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.html">
              Shop
            </a>
          </li>
        </ul>
        <div class="user_option">

            @if(Route::has('login'))
                    @auth
                        <form style="padding: 10px" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="btn btn-success" type="submit" value="Logout">
                        </form>

                        @if(auth()->user()->isAdmin())
                            <a class="btn btn-success" href="{{url('admin/dashboard')}}">
                              <i class="fa fa-tachometer" aria-hidden="true"></i>
                              <span>To Dashboard</span>
                            </a>
                        @else
                            <a class="btn btn-success" href="{{url('/register-seller')}}">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <span>Become a Seller</span>
                            </a>
                        @endif
                    @else
                        <a href="{{url('/login')}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>Login</span>
                        </a>
                        <a href="{{url('/register')}}">
                            <i class="fa fa-vcard" aria-hidden="true"></i>
                            <span>Register</span>
                        </a>
                    @endauth
                @endif

          <a href="">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          </a>

          <form class="form-inline">
            <input type="text" id="search-box" class="form-control" style="display:none;" placeholder="Search...">
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

      searchButton.addEventListener('click', function() {
        if (searchBox.style.display === 'none' || searchBox.style.display === '') {
          searchBox.style.display = 'block';
        } else {
          searchBox.style.display = 'none';
        }
      });
    });
  </script>