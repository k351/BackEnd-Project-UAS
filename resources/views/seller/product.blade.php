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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body>
    @include('seller.header')
    @include('seller.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 style="color: white;">Add Product</h2>
                <div class="d-flex justify-content-center mb-3">
                    <button class="btn btn-primary" aria-expanded="false" data-toggle="collapse" data-target="#productdropdown">
                        Add Product
                    </button>
                </div>
                <ul id="productdropdown" class="collapse list-unstyled">
                    <div class="div_deg">


                      <form action="{{ route('upload_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <table>
                                <tr>
                                    <td>Product Name:</td>
                                    <td><input type="text" name="product_name"></td>
                                </tr>
                                <tr>
                                    <td>Category:</td>
                                    <td>
                                        <select name="category">
                                            <option>Select an Option</option>
                                            @foreach($category as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stock:</td>
                                    <td><input type="text" name="product_stock"></td>
                                </tr>
                                <tr>
                                    <td>Price:</td>
                                    <td><input type="text" name="product_price"></td>
                                </tr>
                                <tr>
                                    <td>Description:</td>
                                    <td><textarea name="product_description" rows="5" cols="43"></textarea></td>
                                </tr>
                                <tr>
                                    <td>Product Image:</td>
                                    <td><input type="file" name="image"></td>
                                </tr>
                            </table>
                            <div class="div_deg">
                                <input class="btn btn-primary" type="submit" value="Add Product">
                            </div>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
        <div class ="div_deg">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div>
            <table class="table_deg">
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th style="padding-right: 100px">
                        <div style="display: flex; justify-content: right;">Description</div>
                    </th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                @foreach($data as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->category->category_name}}</td>
                    <td>{{$data->stock}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->description}}</td>
                    <td>
                      <img height = "120px" width = "120px" src="{{ asset('products/'.$data->image) }}" alt="{{$data->name}}">
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{url('edit_category', $data->id)}}">Edit</a>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category', $data->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- JavaScript files-->
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this category!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>

    <!-- Include Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Toastr Initialization -->
    <script>
        @if(Session::has('toastr'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            }
            toastr.success("{{ Session::get('toastr') }}");
        @endif
    </script>
</body>
</html>
