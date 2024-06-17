<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_center{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .box{
            margin-left: 140px;
        }
        .detail-box{
            padding:15px;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
  </div>

  <!-- Product details start -->

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        <div class="col-md-10">
          <div class="box">
              <div class="div_center">
                <img width="400" src="/images/{{$data->image}}" alt="">
              </div>



              <div class="detail-box">
                <h6>{{$data->name}}</h6>
                <h6>Price
                  <span>{{$data->price}}</span>
                </h6>
              </div>

              <div class="detail-box">
                <h6>Category: {{$data->category->category_name}}</h6>
                <h6>Available Quantity
                  <span>{{$data->stock}}</span>
                </h6>
              </div>

              <div class="detail-box">
                  <p>{{$data->description}}</p>
                </h6>
              </div>


          </div>
        </div>

      </div>
        <div class="text-center mt-4">
            <a href="{{ route('transaction.index', $data->id) }}" class="btn btn-primary" style="background:green; color:white">Checkout</a>
         </div>
    </div>


  </section>



  <!-- product details end-->


  <!-- info section -->
    @include('home.footer')
</body>

</html>
