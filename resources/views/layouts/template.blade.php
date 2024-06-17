<!DOCTYPE html>
<html>
   @include('layouts.head')

    <body>
       @include('layouts.menu')
        <!-- end hero area -->

        <!-- shop section -->

      @yield('content')

        <!-- end shop section -->

        <!-- info section -->

         @include('layouts.footer')

        <!-- end info section -->

        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
