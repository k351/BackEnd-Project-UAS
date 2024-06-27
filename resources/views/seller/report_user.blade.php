<!DOCTYPE html>
<html>
  <head> 
    @include('seller.css')
    <style>
        .user-actions-container {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }
        .user-actions-container form {
            flex: 1;
            margin: 0 2px;
        }
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #4a4a4a;
            border-radius: 5px;
            resize: vertical;
            box-sizing: border-box;
            background-color: #333333;
            color: #ffffff;
        }
        textarea::placeholder {
            color: #cccccc;
        }
    </style>
  </head>
  <body>
    @include('seller.header')
    @include('seller.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid d-flex justify-content-center">
            <div class="col-lg-4 user-block" data-username="{{ $user->name }}" data-usertype="{{ $user->type }}">
              <div class="block text-center">
                  <a href="#" class="user-title">
                      <h3 class="h5">{{ $user->name }}</h3>
                      <span>{{ $user->email }}</span>
                  </a>
                  <div class="user-actions-container mt-3">
                    <form action="{{ route('give.report', ['id' => $user->id, 'rating_id' => $rating_id]) }}" method="post">
                      @csrf
                      <div class="form-group">
                          <textarea name="reason" id="reason" rows="5" placeholder="Reason to report"></textarea>
                      </div>
                      @error('reason')
                        <div class="error-message">{{ $message }}</div>
                      @enderror
                      <button type="submit" name="action" value="banned" class="btn btn-danger ban-btn">Report</button>
                    </form>          
                  </div>
              </div>
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