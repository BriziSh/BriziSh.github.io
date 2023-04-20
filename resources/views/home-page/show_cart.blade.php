<!DOCTYPE html>
<html>
   <head>
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
      <title>Famms - Cart</title>
      
      @include('home-page.css_section')

   </head> 
   <body>
    <div class="hero_area">
         <!-- header section strats -->
         
         @include('home-page.header_section')
         <!-- end header section -->
        </div>
      @include('home-page.session_section')
     
      <div class="div_center">
        <table class="table_center">
            <thead>
                <tr>
                    <th>PRODUCT TITLE</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>IMAGE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; ?>
                @forelse ($carts as $cart)
                    <tr>
                        <td>{{$cart->product->prod_title}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>${{$cart->price}}</td>
                        <td>
                            @if($cart->product->prod_image==null) 
                            <img src="images/no-image.png" alt="Product Img"  class="table_img_size">
                            @else
                            <img src="images/products/{{$cart->product->prod_image}}" alt="Product Img"  class="table_img_size">
                            @endif
                        </td>
                        <td><a href="delete_cart/{{$cart->id}}" class="btn" onclick="return confirm('Are you sure to remove this product?');">Remove Product</a></td>
                    </tr>
                    <?php $total+=$cart->price; ?>
                @empty 
                    <tr>
                        <td colspan="5">No products</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
   
        <div class="d-flex align-items-center justify-content-center">
            <div class="p-1">
                {{$carts->links("vendor.pagination.bootstrap-4")}}
            </div>
        </div>
        <h5 class="price">Total Price: ${{$total}}</h5>
        <h4>Proceed to order: </h4> 

        <form method="POST" class="search-btn" action="order">
            @csrf
            <label>Full Name: </label><input type="text" name="name" value="{{auth()->user()->name}}"><br>
            @error("name") <p class="error">*{{$message}}</p> @enderror
            <label>Phone Number: </label><input type="text" name="phone" value="{{auth()->user()->phone}}"><br>
            @error("phone") <p class="error">*{{$message}}</p> @enderror
            <label>Address: </label> <input type="text" name="address"><br>
            @error("address") <p class="error">*{{$message}}</p> @enderror
     
            {{-- <input type="hidden" name="total" value="{{$total}}"> --}}
            <?php session()->put('total', $total); ?>
            <button type="submit" class="btn btn-dark" name="cash_order" value="true">Cash On Delivery</button>
            <button type="submit" class="btn btn-dark" name="cart_order" value="true">Pay Using Card</button>
        </form>
  
</div>

      <!-- footer start -->
      @include('home-page.footer_section')
      <!-- footer end -->

     <!-- rights reserved start -->
     @include('home-page.rights_section')
     <!-- rights reserved end -->
     
     @include('home-page.js_section')

   </body>
</html>