<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://localhost/e-commerce/public/admin-file">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Subcategory</title>
    
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
                    
                    <h4 class="card-title">Add Subcategory to '{{$category->category_name}}'</h4>
                    <form  method="POST" action="add_subcategory/{{$category->id}}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" name="subcategory_name" class="form-control" placeholder="Write subcategory name" aria-label="Write subcategory name" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2">Add Subcategory</button>
                        </div>
                    </div>         
                    </form>
                    @error("subcategory_name") <p class="error">*{{$message}}</p> @enderror

                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Delete Subcategory</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($subcategories as $subcategory)
                          <tr>
                            <td>{{$category->category_name}}</td>
                            <td>{{$subcategory->subcategory_name}}</td>
                            <td><a href="delete_subcategory/{{$subcategory->id}}" onclick="return confirm('Are you sure you want to delete this subcategory?')" class="btn btn-danger">Delete</a></td>            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No results</td>
                        </tr>
                        @endforelse 
                      </tbody>
                    </table>
                    {{-- <div class="d-flex align-items-center justify-content-center">
                        <div class="p-4" >
                            {{$subcategories->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>  --}}
            </div>
          </div>
        </div>
              <!-- plugins:js -->
    <!-- End custom js for this page -->
        </div>
        @include('admin-page.footer_section')

      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller ends -->


    <!-- plugins:js -->
    @include('admin-page.js_section')
    <!-- End custom js for this page -->
  </body>
</html>