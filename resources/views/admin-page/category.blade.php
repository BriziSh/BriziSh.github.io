<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <title>Category</title>
    
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
                    
                    <h4 class="card-title">Add Category</h4>
                    <form  method="POST" action="add_category">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" name="category_name" class="form-control" placeholder="Write category name" aria-label="Write category name" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2">Add Category</button>
                        </div>
                    </div>         
                    </form>
                    @error("category_name") <p class="error">*{{$message}}</p> @enderror

                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Add Subcategory</th>
                            <th>Delete Category</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($categories as $category)
                          <tr>
                            <td>{{$category->category_name}}</td>
                            <td><a href="subcategory/{{$category->id}}" class="btn btn-success">Add</a></td>
                            <td><a href="delete_category/{{$category->id}}" onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-danger">Delete</a></td>            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No results</td>
                        </tr>
                        @endforelse 
                      </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="p-4" >
                            {{$categories->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div> 
                    
                {{-- <div class="div_center">
                    <h3 class="extra_paddings">Add Category</h3>
                    <form method="POST" action="add_category">
                        @csrf
                        <input type="text" name="category_name" style="margin-right:20px" placeholder="Write category name">
                        <button type="submit" class="btn btn-primary" >Add Category</button>
                    </form>
                    @error("category_name") <p class="error">*{{$message}}</p> @enderror
                    <br>
                    <table class="table_center">
                        <thead>
                            <tr>
                                <th>Table Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>{{$category->category_name}}</td>
                                <td><a href="delete_category/{{$category->id}}" onclick="return confirm('Are you sure you want to delete this category?')" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">---------No categories----------</td>
                            </tr>
                            @endforelse 
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="p-4" >
                            {{$categories->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div> 
                    
                </div> --}}
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