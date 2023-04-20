<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <style>
      .hidden{
        display:none!important;
      }
    </style>
   
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
                        <h4 class="card-title">Add Product</h4>
                        <p class="card-description">Fill all the data needed to add a new product</p>
                        <form class="forms-sample" method="POST" action="add_products" enctype="multipart/form-data">
                        @csrf
                          <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Title:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="prod_title" value="{{old('prod_title')}}" placeholder="Write a title">
                                @error("prod_title") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Product Description: </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="prod_description" value="{{old('prod_description')}}" placeholder="Write a description">
                              @error("prod_description") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Product Price: </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="prod_price" value="{{old('prod_price')}}"  placeholder="Write a price">
                              @error("prod_price") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Discount Price: </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="prod_discount" value="{{old('prod_discount')}}"   placeholder="Write a discount">
                              @error("prod_discount") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Product Quantity: </label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="prod_quantity" value="{{old('prod_quantity')}}"  placeholder="Write a quantity">
                              @error("prod_quantity") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>

                          {{-- @foreach($categories as $category)
                          <div class="form-group">
                            <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">'{{$category->category_name}}' Category: </label>
                            @foreach($subcategories as $subcategory)
                            <div class="form-check" style="display:inline-block">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category_{{$category->id}}" id="optionsRadios2" value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}
                              </label>
                            </div>
                            @endforeach
                          </div>
                        @endforeach --}}

                        {{-- @foreach($categories as $category)
                        <div class="form-group">
                          <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">'{{$category->category_name}}' Category: </label>
                          <input type="hidden" name="subcategories[{{$category->id}}][]" value="">
                          @foreach($subcategories as $subcategory)
                            <div class="form-check" style="display:inline-block">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="subcategories[{{$category->id}}][]" id="optionsRadios2" value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}
                              </label>
                            </div>
                          @endforeach
                        </div>
                      @endforeach --}}

                      @foreach($categories as $category)
                        <div class="form-group">
                            <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">'{{$category->category_name}}' Category: </label>
                            <?php $subcategories = $category->subcategories; ?>
                            <input type="hidden" name="subcategories[{{$category->id}}][]" value="">
                            @foreach($subcategories as $subcategory)
                                <div class="form-check" style="display:inline-block">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="subcategories[{{$category->id}}][]" id="optionsRadios2" value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach


                          <div class="form-group row">
                            <label for="exampleInputConfirmtext2" class="col-sm-3 col-form-label">Product Image: </label>
                            <div class="col-sm-9">
                              <input type="file" name="prod_image"  class="form-control">
                              @error("prod_image") <p class="error">*{{$message}}</p> @enderror
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                        </form>
                  {{-- 
                        <h3>Add Product</h3>
                    <form method="POST" action="add_products" enctype="multipart/form-data">
                        @csrf
                        <label>Product Title: </label><input type="text" name="prod_title" class="fixed_in_height" value="{{old('prod_title')}}" placeholder="Write a title"><br>
                        @error("prod_title") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Description: </label><input type="text" name="prod_description" class="fixed_in_height" value="{{old('prod_description')}}" placeholder="Write a description"><br>
                        @error("prod_description") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Price: </label><input type="text" name="prod_price" class="fixed_in_height" value="{{old('prod_price')}}"  placeholder="Write a price"><br>
                        @error("prod_price") <p class="error">*{{$message}}</p> @enderror
                        <label>Discount Price: </label><input type="text" name="prod_discount" class="fixed_in_height" value="{{old('prod_discount')}}"   placeholder="Write a discount"><br>
                        @error("prod_discount") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Quantity: </label><input type="text" name="prod_quantity" class="fixed_in_height" value="{{old('prod_quantity')}}"  placeholder="Write a quantity"><br>
                        @error("prod_quantity") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Category: </label><select class="fixed_in_height" name="category_id">
                            {{-- para db relationships
                            @foreach ($categories as $category)
                                <option value="{{$category->category_name}}" @php echo (old('prod_category')==$category->category_name)?"selected":"" @endphp> {{$category->category_name}}</option>
                            @endforeach  --}}

                            {{-- pas db relationships --}}{{--
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @php echo (old('category_id')==$category->id)?"selected":"" @endphp> {{$category->category_name}}</option>
                            @endforeach 
                        </select><br>
                        @error("category_id") <p class="error">*{{$message}}</p> @enderror
                        <label>Product Image: </label><input type="file" name="prod_image" class="fixed_in_height" style="width:250px"><br>
                        @error("prod_image") <p class="error">*{{$message}}</p> @enderror 
                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Add Product</button>
                    </form> --}}
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