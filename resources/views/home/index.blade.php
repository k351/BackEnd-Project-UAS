<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->
  </div>
  
  <div class="heading_container heading_center">
    <h2 style="padding-top: 70px;">
    Latest Products
    </h2>
  </div>
  <!-- end hero area -->
    @include('home.product')
  <!-- shop section -->

  <!-- end shop section -->

  <!-- info section -->
    @include('home.footer')
</body>

</html>