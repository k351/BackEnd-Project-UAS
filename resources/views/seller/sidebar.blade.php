<div class="d-flex align-items-stretch">
  <!-- Sidebar Navigation-->
  <nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="{{asset('/admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <p>Shop Owner</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{route('create.seller.dashboard')}}"> <i class="icon-home"></i>Home</a></li>
            <li class="active"><a href="{{route('view.product')}}"> <i class="icon-home"></i>Product</a></li>
            <li class="active"><a href="{{route('home')}}"> <i class="icon-home"></i>Back To Main Page</a></li>
            <li class="active"><a href="{{route('get.review')}}"> <i class="icon-home">Review</i></a></li>
    </ul>
  </nav>
  <!-- Sidebar Navigation end-->