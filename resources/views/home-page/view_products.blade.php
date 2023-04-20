<!DOCTYPE html>
<html>
   <head>
      <base href="http://localhost/e-commerce/public/home-files">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home-files/images/favicon.png" type="">
      <title>Famms - Products</title>
      
      @include('home-page.css_section')

   </head> 
   <body>
      
  

      <!-- header section strats -->
      @include('home-page.header_section')
      <!-- end header section -->
      
      <!-- product section -->
      <section class="product_section">
       {{--class layout_padding --}}
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div> 
     
            <div class="center-align">
              {{-- <form method="GET" action="products_search"> --}}
               <form method="GET" action="view_products">
                 <input type="text" name="search" placeholder="Search For Products by Product Name" class="search-box">
                 <input type="submit" value="Search" class="search-btn">
              </form>
            </div>
            <br>
            
            @include('home-page.session_section')
     
            <div class="search-orderby-layout">

            <div class="search-orderby">
               @if(isset($category))
                  <div class="category">
                     <a href="view_products/{{$category->id}}">{{$category->category_name}}</a>
                  </div>
               @endif
               @if(isset($subcategory))
               <div class="category">
                  <a href="view_products/{{$category->id}}/{{$subcategory->id}}">- {{$subcategory->subcategory_name}}</a>
               </div>
               @endif
               @if(isset($_GET["search"]) && $_GET["search"]!="") <p>Search results for: '{{$_GET["search"]}}'</p>
               @else
                  @if(isset($_GET["order-by"]))
                  <p>Sort By: '{{$_GET["order-by"]}}'</p>
                  @else <p>Sort By: 'Default'</p>
                  @endif
               <div class="container w-25" style="margin-right:0">
                  <select class="browser-default custom-select" onchange="test()" id="myselect">
                     <option selected>Sort by: Default</option>
                     <option value="Latest">Sort by: Latest</option>
                     <option value="Low to High">Sort by: Price: Low to High</option>
                     <option value="High to Low">Sort by: Price: High to Low</option>
                   </select>
               </div>
               @endif
            </div>
        
               
            <div class="row"> 
            <?php $no_products=true; ?>
            @if(!$products->isEmpty())
              @foreach ($products as $product) 
              <?php if($product->prod_quantity==0) continue; ?>
              <?php $no_products=false; ?> 
                 <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                       <div class="option_container"> 
                          <div class="options">
                             <a href="product_details/{{$product->id}}" class="option1">
                             Product Details
                             </a><br>
     
                             <form action="add_cart/{{$product->id}}" method="POST">
                             @csrf
                                <input name="quantity" type="number" value="1" min="1" max="{{$product->prod_quantity}}" class="option2" style="background: white; color:black;"><br>
                                <button type="submit" class="option2">Add to Cart</button>
                             </form>
                          </div>
                       </div>
                       <div class="img-box">
                        @if($product->prod_image!=null)
                        <img src="images/products/{{$product->prod_image}}" alt="Product Image" width="90%" height="70%;">
                        @else
                        <img src="images/no-image.png" alt="Product Image" width="90%" height="70%;">
                        @endif
                       </div>
                       <div class="detail-box">
                          <h5>
                             {{$product->prod_title}}
                          </h5>
     
                          @if($product->prod_discount!=null)
                             <h6 class="discount">
                                Discount price<br>
                                ${{$product->prod_discount}}
                             </h6>
                             <h6 class="price" style="text-decoration: line-through;">
                                Price<br>
                                ${{$product->prod_price}}
                             </h6>
                          @else
                             <h6 class="price">
                                Price<br>
                                ${{$product->prod_price}}
                             </h6>
                          @endif
                       </div>
                    </div>
                 </div>
              @endforeach
            @endif
            @if($products->isEmpty() || $no_products==true)
            <div class="search-noresults">
               <span>No results</span>
            </div>
            @endif
            </div>
     
            {{-- "vendor.pagination.bootstrap-4" --}}
           <div class="p-4" style="padding-bottom:0!important">
              {{$products->links("vendor.pagination.bootstrap-5")}}
           </div>
            {{-- Kontrolloje per ca duhet kjo --}}
            <div class="btn-box">
               <a href="view_products">
               View All products
               </a>
            </div>
            </div>
        
      </section>
      <!-- end product section -->

      {{-- @include('home-page.comment_section') --}}
      
      @include('home-page.footer_section')

      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->
      
      @include('home-page.js_section')

   </body>
</html>