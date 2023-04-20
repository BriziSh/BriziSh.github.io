<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Change Password</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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

                <div class=" card">
                <div class="card-body">

                    <h4 class="card-title">Change Password</h4>
                    <p class="card-description">Write your old and new password</p>
                    <form class="forms-sample" method="POST" action="change_password">
                    @csrf
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Old Password: </label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="old_pass" value="{{old('old_pass')}}" placeholder="********">
                            @error("old_pass") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">New Password: </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_pass" value="{{old('new_pass')}}" placeholder="********">
                            @error("new_pass") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Repeat New Password: </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_pass_confirmation" value="{{old('new_pass_confirmation')}}" placeholder="********">
                            @error("new_pass_confirmation") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                     
                      <button type="submit" class="btn btn-primary mr-2">Confirm</button>
                     
                    </form></div></div>
        
                {{-- <div class="div_center">
                    <h3 class="extra_paddings">Change Password</h3>
                    <form method="POST" action="change_password">
                        @csrf
                        <label>Old Password: </label><input type="password" name="old_pass" class="fixed_in_height" value="{{old('old_pass')}}" placeholder="********"><br>
                        @error("old_pass") <p class="error">*{{$message}}</p> @enderror
                        <label>New Password: </label><input type="password" name="new_pass" class="fixed_in_height" value="{{old('new_pass')}}" placeholder="********"><br>
                        @error("new_pass") <p class="error">*{{$message}}</p> @enderror
                        <label>Repeat New Password: </label><input type="password" name="new_pass_confirmation" class="fixed_in_height" value="{{old('new_pass_confirmation')}}" placeholder="********"><br>
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