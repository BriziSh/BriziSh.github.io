<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Account Settings</title>
    
    <!-- plugins:css -->
    @include('admin-page.css_section')
  </head>
  <body>
    <!-- container-scroller starts -->
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      @include('admin-page.sidebar_section')

      <!-- page-body-wrapper starts -->
      <div class="container-fluid page-body-wrapper">

        <!-- partial:partials/_navbar.html -->
        @include('admin-page.header_section')
        
        <!-- main-panel -->
        <div class="main-panel">
            <div class="content-wrapper">

                @include('admin-page.session_section')

                <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Account Settings</h4>
                    <p class="card-description">Update your account data</p>
                    <form class="forms-sample" method="POST" action="account_settings">
                    @csrf
                    @php $user = auth()->user() @endphp

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Full Name:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            @error("name") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="email" value="{{$user->email}}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Phone: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                          @error("phone") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-2">Confirm</button>
                     
                    </form>
                </div></div>
        
                {{-- <div class="div_center">
                    <h3 class="extra_paddings">Account Settings</h3>
                    <form method="POST" action="account_settings">
                        @csrf
                        @php $user = auth()->user() @endphp
                        
                        <label>Full Name: </label><input type="text" name="name" class="fixed_in_height" value="{{$user->name}}"><br>
                        @error("name") <p class="error">*{{$message}}</p> @enderror
                        <label>Email: </label><input type="text" name="email" class="fixed_in_height" value="{{$user->email}}" readonly><br>
                        <label>Phone: </label><input type="text" name="phone" class="fixed_in_height" value="{{$user->phone}}"><br>
                        @error("phone") <p class="error">*{{$message}}</p> @enderror

                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Confirm</button> 
                    </form>
                </div> --}}
            </div>
                             <!-- plugins:js -->
    @include('admin-page.footer_section')
    <!-- End custom js for this page -->
        </div>
        
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller ends -->


    <!-- plugins:js -->
    @include('admin-page.js_section')
    <!-- End custom js for this page -->
  </body>
</html>