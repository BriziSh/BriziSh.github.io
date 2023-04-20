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
      <title>Famms - {{$product->prod_title}}</title>

      @include('home-page.css_section')
      
   </head>
   <body>
    
      <div class="hero_area">
         <!-- header section strats -->
         @include('home-page.header_section')
         <!-- end header section -->
      

      @include('home-page.session_section')
        
      {{-- Trupi me detajet e produktit --}}
      <section id="details" >
         {{-- <div class="col-sm-6 col-md-4 col-lg-4 center_div"> --}}
            <div class="box">
               <div class="detail-box ">
                  <div class="img-div">
                       @if($product->prod_image!=null)
                     <img src="images/products/{{$product->prod_image}}" alt="Product Image" class="img_size">
                     @else
                     <img src="images/no-image.png" alt="Product Image" class="img_size">
                     @endif
                  </div>
                
                 <div class="data-div">
                     <h5>{{$product->prod_title}}</h5>

                     @if ($product->prod_discount!=null)
                        <h6 class="discount">
                           <strong>Discount price: </strong>
                           ${{$product->prod_discount}}
                        </h6>
                        <h6 class="price" style="text-decoration: line-through;">
                           <strong>Price: </strong>
                           ${{$product->prod_price}}
                        </h6>
                     @else
                        <h6 class="price">
                           <strong>Price: </strong>
                           ${{$product->prod_price}}
                        </h6>
                     @endif

                     <h6><strong>Tags: </strong> 
                        <?php $subcategories = $product->subcategories; ?>
                        @foreach($subcategories as $subcategory)
                        @if ($loop->last)
                          {{ $subcategory->subcategory_name }}
                        @else
                          {{ $subcategory->subcategory_name }},
                        @endif
                      @endforeach
                     </h6>
                     <h6><strong>Product Details: </strong><br>{{$product->prod_description}}</h6>
                     <h6><strong>Available Quantity: </strong>{{$product->prod_quantity}}</h6><br>
                     <form action="add_cart/{{$product->id}}" method="POST">
                        @csrf
                           <input name="quantity" type="number" value="1" min="1" max="{{$product->prod_quantity}}" style="width:10%">
                           <input type="submit" class="search-btn" value="Add to Cart">
                     </form>
                 </div>
                 
               </div>
            </div>
         </div>
      </section>
   </div> 
   <br><br>

         
      @include('home-page.comment_section')
        
      <!-- footer start -->
      @include('home-page.footer_section')
      <!-- footer end -->
      
      <!-- rights reserved start -->
      @include('home-page.rights_section')
      <!-- rights reserved end -->
      
      @include('home-page.js_section')

   </body>
</html>