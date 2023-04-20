<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
          <h2>
             Our <span>products</span>
          </h2>
       </div>

       <div class="center-align">
         <form method="GET" action="">
            <input type="text" name="search" placeholder="Search For Products by Product Name" class="search-box">
            <input type="submit" value="Search" class="search-btn">
         </form>
       </div>

       <div class="search-results">
         @if(isset($_GET["search"]) && $_GET["search"]!="") <p>Search results for: '{{$_GET["search"]}}'</p>
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

                     @if ($product->prod_discount!=null)
                        <h6 class="discount">
                           Discount price<br>
                           ${{$product->prod_discount}}
                        </h6>
                        <h6 class="price" style="text-decoration:line-through;"> 
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
          <span><strong>No results</strong></span>
       </div>
       @endif 
      </div>

      {{-- "vendor.pagination.bootstrap-4" --}}
      <div class="p-4" style="padding-bottom:0!important">
         {{$products->links("vendor.pagination.bootstrap-5")}}
      </div>
       <div class="btn-box">
          <a href="http://localhost/e-commerce/public/view_products">
          View All products
          </a>
       </div>
    </div>
 </section>