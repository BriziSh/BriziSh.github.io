<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://localhost/e-commerce/public/admin-file">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Send Email</title>
    
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
                    <h4 class="card-title">Send Email to '{{$order->cart->user->email}}'</h4>
                    <p class="card-description">Write an email to customer</p>
                    <form class="forms-sample" method="POST" action="send_email_notification/{{$order->id}}">
                    @csrf
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email Greeting: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="greeting" value="{{old('greeting')}}">
                            @error("greeting") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email First Line: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="firstline" value="{{old('firstline')}}">
                          @error("firstline") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email Body: </label>
                        <div class="col-sm-9">
                           <textarea name="body" class="form-control" id="exampleTextarea1" rows="4">{{old('body')}}</textarea>
                           @error("body") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Email Button Name: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="button" value="{{old('button')}}">
                          @error("button") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Email Url: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="url" value="{{old('url')}}">
                          @error("url") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Email Last Line: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="lastline" value="{{old('lastline')}}">
                          @error("lastline") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Send Email</button>
                     
                    </form>
                </div></div>
        
                {{-- <div class="div_center"> 
                    <h3 class="extra_paddings">Send Email to '{{$order->cart->user->email}}'</h3>
                    <form method="POST" action="send_email_notification/{{$order->id}}">
                        @csrf
                        <label>Email Greeting: </label><input type="text" name="greeting" class="fixed_in_height" value="{{old('greeting')}}"><br>
                        @error("greeting") <p class="error">*{{$message}}</p> @enderror
                        <label>Email First Line: </label><input type="text" name="firstline" class="fixed_in_height" value="{{old('firstline')}}"><br>
                        @error("firstline") <p class="error">*{{$message}}</p> @enderror
                        <label style="padding-bottom:0">Email Body: </label><textarea name="body">{{old('body')}}</textarea><br>
                        @error("body") <p class="error">*{{$message}}</p> @enderror
                        <label>Email Button Name: </label><input type="text" name="button" class="fixed_in_height" value="{{old('button')}}"><br>
                        @error("button") <p class="error">*{{$message}}</p> @enderror
                        <label>Email Url: </label><input type="text" name="url" class="fixed_in_height" value="{{old('url')}}"><br>
                        @error("url") <p class="error">*{{$message}}</p> @enderror
                        <label>Email Last Line: </label><input type="text" name="lastline" class="fixed_in_height" value="{{old('lastline')}}"><br>
                        @error("lastline") <p class="error">*{{$message}}</p> @enderror
                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Send Email</button> 
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