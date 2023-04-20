<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>All Products</title>
  
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

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">All Products</h4>
                        @if(isset($_GET["search-admin"]) && $_GET["search-admin"]!="") 
                        <div class="search-results">
                            <p>Search results for: '{{$_GET["search-admin"]}}'</p>
                        </div>
                        @endif
             
                        
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="fix-left">ID</th>
                                <th>Product title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Tags</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Product Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($products as $product)
                              <tr>
                                <td class="fix-left">{{$product->id}}</td>
                                <?php $str = substr($product->prod_title, 0, 20);?>
                                <td>{{$str}}</td>
                                <?php $str = substr($product->prod_description, 0, 20);?>
                                <td>{{$str}}</td>

                                <td>{{$product->prod_quantity}}</td>
                                <?php 
                                $subcategories = $product->subcategories()->get();
                                $subcategoriesArray = $subcategories->pluck('id')->toArray(); 
                                ?>
                                <td>[
                                  @foreach($subcategories as $subcategory)
                                    @if ($loop->last)
                                      {{ $subcategory->subcategory_name }}
                                    @else
                                      {{ $subcategory->subcategory_name }},
                                    @endif
                                  @endforeach
                                ]</td>
                                <td>{{$product->prod_price}}</td>
                                <td>{{$product->prod_discount}}</td> 
                                <td> 
                                    @if($product->prod_image!=null)
                                    <img src="images/products/{{$product->prod_image}}" alt="Product Image" class="img_size">
                                    @else
                                    <img src="images/no-image.png" alt="Product Image" class="img_size">
                                    @endif
                                </td> 
                                <td><a href="view_edit_products/{{$product->id}}" class="btn btn-success">Edit</a></td>
                                <td><a href="delete_products/{{$product->id}}" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger">Delete</a></td>
                              </tr>
                              @empty
                              <tr>
                                  <td colspan="9">No products</td>
                              </tr>
                              @endforelse 

                            </tbody>
                          </table>
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="p-4" >
                                {{$products->links("vendor.pagination.bootstrap-4")}}
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>

                {{-- <div class="div_center">
                    <h3 class="extra_paddings">All Products</h3>
                    @if(isset($_GET["search-admin"]) && $_GET["search-admin"]!="") 
                    <div style="text-align:center; font-size:30px; font-weight:bold; margin-top:20px;">
                        <p>Search results for: '{{$_GET["search-admin"]}}'</p>
                    </div>
                    @endif
                    <table class="table_center">
                        <thead>
                            <tr>
                                <th>Product title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Catagory</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Product Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td>{{$product->prod_title}}</td>
                                <td>{{$product->prod_description}}</td>
                                <td>{{$product->prod_quantity}}</td>
                                <td>{{$product->category->category_name}}</td>
                                <td>{{$product->prod_price}}</td>
                                <td>{{$product->prod_discount}}</td> 
                                <td> 
                                    @if($product->prod_image!=null)
                                    <img src="images/products/{{$product->prod_image}}" alt="Product Image" class="img_size">
                                    @else
                                    <img src="images/no-image.png" alt="Product Image" class="img_size">
                                    @endif
                                </td>                                
                                <td><a href="view_edit_products/{{$product->id}}" class="btn btn-success">Edit</a></td>
                                <td><a href="delete_products/{{$product->id}}" onclick="return confirm('Are you sure you want to delete this product?')" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9">No products</td>
                            </tr>
                            @endforelse 
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="p-4" >
                            {{$products->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
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