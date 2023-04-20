<!DOCTYPE html>
<html lang="en">
  <head>
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

                <div class=" card">
                <div class="card-body">
                    <h3 class="card-title">Send Email to All Subscribers</h4>
                    <p class="card-description">Write an email for all subscribers to inform them of discounts or new arrivals</p>
                    <form class="forms-sample" method="POST" action="email_all">
                    @csrf
                    <input type="hidden" name="greeting" value="Hi there!">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email First Line:</label>
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
                      <input type="hidden" name="button" value="Click here to view the discounts!">
                      <input type="hidden" name="url" value="http://localhost/e-commerce/public/view_products">
                      <input type="hidden" name="lastline" value="We will come back soon with new discounts!">
                      <button type="submit" class="btn btn-primary mr-2">Send Email</button>
                     
                    </form></div></div>
                
{{--         
                <div class="div_center">
                    <h3 class="extra_paddings">Send Email to All Subscribers</h3>
                    <form method="POST" action="email_all">
                        @csrf
                        <input type="hidden" name="greeting" value="Hi there!">
                        <label>Email First Line: </label><input type="text" name="firstline" class="fixed_in_height" value="{{old('firstline')}}"><br>
                        @error("firstline") <p class="error">*{{$message}}</p> @enderror
                        <label>Email Body: </label>
                        <textarea name="body" rows="5" placeholder="Write the discount offer"></textarea>
                        @error("body") <p class="error">*{{$message}}</p> @enderror<br>
                        <input type="hidden" name="button" value="Click here to view the discounts!">
                        <input type="hidden" name="url" value="http://localhost/e-commerce/public/view_products">
                        <input type="hidden" name="lastline" value="We will come back soon with new discounts!">
                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Send Email</button> 
                    </form>
                </div> --}}
                <br><br>

                {{-- //nxirr gjithe subsribers dhe hiq ato qe nuk duhen --}}
                {{-- <div class="div_center"> --}}
                  <div class=" card">
                    {{-- div_center --}}
                <div class="card-body">  
                  <div>
                        <h4 class="card-title">All Subscribers</h3>
                        @forelse($subscribers as $subscriber)
                        <p>{{$subscriber->email}}
                        <a href="delete_subscriber/{{$subscriber->id}}" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger" method="get">X</a>
                        </p>
                        @empty
                        <p>No Subscribers</p>
                        @endforelse
                    </div>
                      
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="p-1" >
                            {{$subscribers->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
                </div>
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