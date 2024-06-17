<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
      .centerize{
        display:flex;
        justify-content:center;
        align-items:center;
        marign-top:60px;
      }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
   
    <!-- end hero area -->
    @include('home.product')
    <!-- shop section -->

    <div class="centerize">
      {{$product->onEachSide(1)->links()}}
    </div>

  <!-- info section -->
    @include('home.footer')
</body>

</html>