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
    <h2 class="h5 no-margin-bottom">Dashboard</h2>
    </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-user-1"></i></div><strong>Total Users</strong>
                            </div>
                            <div class="number dashtext-1">{{ $totalUsers }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-contract"></i></div><strong>Total Sellers</strong>
                            </div>
                            <div class="number dashtext-2">{{ $totalSellers }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Total Categories</strong>
                            </div>
                            <div class="number dashtext-3">{{ $totalCategories }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-3"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Total Products</strong>
                            </div>
                            <div class="number dashtext-4">{{ $totalProducts }}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"
                                class="progress-bar progress-bar-template dashbg-4"></div>
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
                    <form action="{{route('admin.search')}}" method="get">
                        <div class="search-bar-container">
                                <input type="text" id="search" name="search" class="form-control search-bar" placeholder="Search for users...">
                                <button class="btn btn-danger">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- User Blocks with Actions -->
    <section class="no-padding-bottom">
      <div class="container-fluid">
          <div class="row" id="user-list">
        
        @foreach ($users as $user)
            <div class="col-lg-4 user-block" data-username="{{ $user->name }}" data-usertype="{{ $user->type }}">
                <div class="block text-center">
                    <div class="avatar"><img src="{{ $user->avatar }}" alt="..." class="img-fluid">
                    </div>
                    <a href="#" class="user-title">
                        <h3 class="h5">{{ $user->name }}</h3>
                        <span>{{ $user->email }}</span>
                    </a>
                    <div>{{ $user->name }} cases Reported</div>
                    <div>Status: {{ $user->status }} </div>
                    <div class="user-actions-container mt-3">
                        @if($user->status === "none")
                            <form action="{{route('admin.take.action',['id' => $user->id])}}" method="get">
                                @csrf
                                <button class="btn btn-warning timeout-btn">Take Action</button>
                            </form>
                        @else
                            <form action="{{route('admin.remove.action',['id' => $user->id])}}" method="get">
                                @csrf
                                <button class="btn btn-warning timeout-btn">Remove Action</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
          </div>
          <div class="d-flex justify-content-center">
              {{ $users->links() }} <!-- Pagination links -->
          </div>
      </div>
  </section>
                <!-- Add more user blocks as needed -->
            </div>
        </div>
    </section>
    <!-- Include your remaining sections here -->
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