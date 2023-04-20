<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="http://localhost/e-commerce/public/admin-files">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Edit Product</title>
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
                    <h4 class="card-title">Edit Product</h4>
                    <p class="card-description">Be careful if you reduce the number of quantity</p>
                    <form class="forms-sample" method="POST" action="edit_products/{{$product->id}}" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Title:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="prod_title" value="{{$product->prod_title}}">
                            @error("prod_title") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Product Description: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="prod_description" value="{{$product->prod_description}}">
                          @error("prod_description") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Product Price: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="prod_price" value="{{$product->prod_price}}" >
                          @error("prod_price") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Discount Price: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="prod_discount" value="{{$product->prod_discount}}">
                          @error("prod_discount") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Product Quantity: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="prod_quantity" value="{{$product->prod_quantity}}">
                          @error("prod_quantity") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      {{-- <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Product Category: </label>
                        <div class="col-sm-9">
                          <select name="category_id" class="form-control" >
                            @foreach ($categories as $category)
                            <option  value="{{$category->id}}" @php echo ($product->category_id==$category->id)?"selected":"" @endphp> {{$category->category_name}}</option>
                            @endforeach 
                          </select>
                          @error("cateogory_id") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div> --}}

                      @foreach($categories as $category)
                      <div class="form-group">
                          <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">'{{$category->category_name}}' Category: </label>
                          <?php $subcategories = $category->subcategories;?>
                          <input type="hidden" name="subcategories[{{$category->id}}][]" value="">
                          <?php  $subcategoryIds = $product->subcategories->pluck('id');  ?>

                          @foreach($subcategories as $subcategory)
                              <div class="form-check" style="display:inline-block">
                                  <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" name="subcategories[{{$category->id}}][]" id="optionsRadios2" value="{{$subcategory->id}}" {{ $subcategoryIds->contains($subcategory->id) ? 'checked' : '' }} >{{$subcategory->subcategory_name}}
                                  </label>
                              </div>
                          @endforeach
                      </div>
                      @endforeach

                      <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Current Product Image: </label>
                        <div class="col-sm-9">
                            @empty($product->prod_image)
                            No image
                            @else
                            <img src="images/products/{{$product->prod_image}}" alt="Current Product Image" style="width:250px">
                            @endempty
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Change Product Image: </label>
                        <div class="col-sm-9">
                          <input type="file" name="prod_image" class="form-control">
                          @error("prod_image") <p class="error">*{{$message}}</p> @enderror
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Edit Product</button>
                     
                    </form>
                </div></div>
        
                {{-- <div class="div_center">
                    <h3 class="extra_paddings">Edit Product</h3>
                    <form method="POST" action="edit_products/{{$product->id}}" enctype="multipart/form-data">
                        @csrf
                        <label>Product Title: </label><input type="text" name="prod_title" class="fixed_in_height" value="{{$product->prod_title}}" placeholder="Write a title"><br>
                        @error("prod_title") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Description: </label><input type="text" name="prod_description" class="fixed_in_height" value="{{$product->prod_description}}" placeholder="Write a description"><br>
                        @error("prod_description") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Price: </label><input type="text" name="prod_price" class="fixed_in_height" value="{{$product->prod_price}}"  placeholder="Write a price"><br>
                        @error("prod_price") <p class="error">*{{$message}}</p> @enderror
                        <label>Discount Price: </label><input type="text" name="prod_discount" class="fixed_in_height" value="{{$product->prod_discount}}"   placeholder="Write a discount"><br>
                        @error("prod_discount") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Quantity: </label><input type="text" name="prod_quantity" class="fixed_in_height" value="{{$product->prod_quantity}}"  placeholder="Write a quantity"><br>
                        @error("prod_quantity") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Category: </label><select class="fixed_in_height" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @php echo ($product->category_id==$category->id)?"selected":"" @endphp> {{$category->category_name}}</option>
                            @endforeach  
                        </select><br>
                        @error("category_id") <p class="error">*{{$message}}</p> @enderror
                        <label>Current Product Image: 
                            @empty($product->prod_image)
                            No image
                            @else
                            <img src="images/products/{{$product->prod_image}}" alt="Current Product Image" style="width:250px"></label> 
                            @endempty
                            <br>
                        <label>Change Product Image: <input type="file" name="prod_image" class="fixed_in_height" style="width:250px"></label><br>
                        @error("prod_image") <p class="error">*{{$message}}</p> @enderror 
                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Edit Product</button>
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