<!DOCTYPE html>
<html>
  <head> 
    @include('seller.css')

    <style type="text/css">
    input[type='text']{
            width: 400px;
            height: 50px;
        }
        .div_deg {
            display: flex;
            margin-top: 20px; 
            justify-content: center;
            align-items: center;
        }
        .div_deg p {
            margin-right: 20px;
            width: 120px;
            text-align: right;
        }
        .div_deg input {
            flex: 1; 
        }
        .table_deg{
            text-align: center;
            margin: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
            width: 1000px;
        }
        th {
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        td {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }
        .input_deg {
            display: flex;
            align-items: center;
            padding: 15px;
        }
    </style>
  </head>
  <body>
    @include('seller.header')
    @include('seller.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h2 style="color: white";>Update Category</h2>

            <div class = "div_deg">
              <form action="{{url('update_product', $data->id)}}" method="post">
                @csrf
                    <table>
                        <tr>
                            <td>Product Name:</td>
                            <td><input type="text" name="product_name" value="{{$data->name}}"></td>
                        </tr>
                        <tr>
                            <td>Category:</td>
                            <td>
                                <select name="category">
                                    <option>Select an Option</option>
                                    @foreach($category as $category)
                                    <option value="{{ $category->id }}" {{$data->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td >Stock:</td>
                            <td><input type="text" name="product_stock" value="{{$data->stock}}"></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td><input type="text" name="product_price" value="{{$data->price}}"></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name="product_description" rows="5" cols="43">{{$data->description}}</textarea></td>
                        </tr>
                        <tr>
                            <td>Product Image:</td>
                            
                            <td>
                              <p>
                                <img height = "120px" width = "120px" src="{{ asset('products/'.$data->image) }}" alt="{{$data->name}}">
                              </p>
                              <input type="file" name="image" value="{{$data->image}}">
                            </td>
                        </tr>
                    </table>
                    <div class="div_deg">
                        <input class="btn btn-primary" type="submit" value="Edit Product">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>